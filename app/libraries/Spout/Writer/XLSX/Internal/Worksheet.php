<?php

namespace Box\Spout\Writer\XLSX\Internal;

use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Helper\StringHelper;
use Box\Spout\Writer\Common\Helper\CellHelper;
use Box\Spout\Writer\Common\Internal\WorksheetInterface;

/**
 * Class Worksheet
 * Represents a worksheet within a XLSX file. The difference with the Sheet object is
 * that this class provides an interface to write data
 *
 * @package Box\Spout\Writer\XLSX\Internal
 */
class Worksheet implements WorksheetInterface
{
    /**
     * Maximum number of characters a cell can contain
     * @see https://support.office.com/en-us/article/Excel-specifications-and-limits-16c69c74-3d6a-4aaf-ba35-e6eb276e8eaa [Excel 2007]
     * @see https://support.office.com/en-us/article/Excel-specifications-and-limits-1672b34d-7043-467e-8e27-269d656771c3 [Excel 2010]
     * @see https://support.office.com/en-us/article/Excel-specifications-and-limits-ca36e2dc-1f09-4620-b726-67c00b05040f [Excel 2013/2016]
     */
    const MAX_CHARACTERS_PER_CELL = 32767;

    const SHEET_XML_FILE_HEADER = <<<EOD
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
EOD;

    /** @var \Box\Spout\Writer\Common\Sheet The "external" sheet */
    protected $externalSheet;

    /** @var string Path to the XML file that will contain the sheet data */
    protected $worksheetFilePath;

    /** @var \Box\Spout\Writer\XLSX\Helper\SharedStringsHelper Helper to write shared strings */
    protected $sharedStringsHelper;

    /** @var \Box\Spout\Writer\XLSX\Helper\StyleHelper Helper to work with styles */
    protected $styleHelper;

    /** @var bool Whether inline or shared strings should be used */
    protected $shouldUseInlineStrings;

    /** @var \Box\Spout\Common\Escaper\XLSX Strings escaper */
    protected $stringsEscaper;

    /** @var \Box\Spout\Common\Helper\StringHelper String helper */
    protected $stringHelper;

    /** @var Resource Pointer to the sheet data file (e.g. xl/worksheets/sheet1.xml) */
    protected $sheetFilePointer;

    /** @var int Index of the last written row */
    protected $lastWrittenRowIndex = 0;

    //by kmj
	public $colWidth;
	public $mergeCells;

    /**
     * @param \Box\Spout\Writer\Common\Sheet $externalSheet The associated "external" sheet
     * @param string $worksheetFilesFolder Temporary folder where the files to create the XLSX will be stored
     * @param \Box\Spout\Writer\XLSX\Helper\SharedStringsHelper $sharedStringsHelper Helper for shared strings
     * @param \Box\Spout\Writer\XLSX\Helper\StyleHelper Helper to work with styles
     * @param bool $shouldUseInlineStrings Whether inline or shared strings should be used
     * @throws \Box\Spout\Common\Exception\IOException If the sheet data file cannot be opened for writing
     */
	public function __construct($externalSheet, $worksheetFilesFolder, $sharedStringsHelper, $styleHelper, $shouldUseInlineStrings, $colWidth=null, $mergeCells=null)
    {
        $this->externalSheet = $externalSheet;
        $this->sharedStringsHelper = $sharedStringsHelper;
        $this->styleHelper = $styleHelper;
        $this->shouldUseInlineStrings = $shouldUseInlineStrings;

        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        $this->stringsEscaper = \Box\Spout\Common\Escaper\XLSX::getInstance();
        $this->stringHelper = new StringHelper();

        $this->worksheetFilePath = $worksheetFilesFolder . '/' . strtolower($this->externalSheet->getName()) . '.xml';
		$this->colWidth = $colWidth;
		$this->mergeCells = $mergeCells;
        $this->startSheet();
    }

    /**
     * Prepares the worksheet to accept data
     *
     * @return void
     * @throws \Box\Spout\Common\Exception\IOException If the sheet data file cannot be opened for writing
     */
    protected function startSheet()
    {
    	$this->sheetFilePointer = fopen($this->worksheetFilePath, 'w');
    	$this->throwIfSheetFilePointerIsNotAvailable();
    	
    	fwrite($this->sheetFilePointer, self::SHEET_XML_FILE_HEADER);
    	if(!is_array($this->colWidth[0])){
    		$loopWidth = $this->colWidth;
    	} else {
    		$loopWidth = $this->colWidth[$this->externalSheet->getIndex()];
    	}
    	
    	if($loopWidth)
    	{
    		$colsStyle = '<cols>';
    		foreach($loopWidth as $k => $width) {
    			$colIndex = $k + 1;
    			$colsStyle .= '<col min="'. $colIndex .'" max="' . $colIndex . '" width="'. $width .'" AutoFitWidth="0"/>';
    		}
    		$colsStyle .= '</cols>';
    		fwrite($this->sheetFilePointer, $colsStyle);
    	}
    	fwrite($this->sheetFilePointer, '<sheetData>');
    }

    /**
     * Checks if the book has been created. Throws an exception if not created yet.
     *
     * @return void
     * @throws \Box\Spout\Common\Exception\IOException If the sheet data file cannot be opened for writing
     */
    protected function throwIfSheetFilePointerIsNotAvailable()
    {
        if (!$this->sheetFilePointer) {
            throw new IOException('Unable to open sheet for writing.');
        }
    }

    /**
     * @return \Box\Spout\Writer\Common\Sheet The "external" sheet
     */
    public function getExternalSheet()
    {
        return $this->externalSheet;
    }

    /**
     * @return int The index of the last written row
     */
    public function getLastWrittenRowIndex()
    {
        return $this->lastWrittenRowIndex;
    }

    /**
     * @return int The ID of the worksheet
     */
    public function getId()
    {
        // sheet index is zero-based, while ID is 1-based
        return $this->externalSheet->getIndex() + 1;
    }

    /**
     * Adds data to the worksheet.
     *
     * @param array $dataRow Array containing data to be written. Cannot be empty.
     *          Example $dataRow = ['data1', 1234, null, '', 'data5'];
     * @param \Box\Spout\Writer\Style\Style $style Style to be applied to the row. NULL means use default style.
     * @return void
     * @throws \Box\Spout\Common\Exception\IOException If the data cannot be written
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException If a cell value's type is not supported
     */
    public function addRow($dataRow, $style)
    {
        if (!$this->isEmptyRow($dataRow)) {
            $this->addNonEmptyRow($dataRow, $style);
        }

        $this->lastWrittenRowIndex++;
    }

    /**
     * Returns whether the given row is empty
     *
     * @param array $dataRow Array containing data to be written. Cannot be empty.
     *          Example $dataRow = ['data1', 1234, null, '', 'data5'];
     * @return bool Whether the given row is empty
     */
    protected function isEmptyRow($dataRow)
    {
        $numCells = count($dataRow);
        // using "reset()" instead of "$dataRow[0]" because $dataRow can be an associative array
        return ($numCells === 1 && CellHelper::isEmpty(reset($dataRow)));
    }

    /**
     * Adds non empty row to the worksheet.
     *
     * @param array $dataRow Array containing data to be written. Cannot be empty.
     *          Example $dataRow = ['data1', 1234, null, '', 'data5'];
     * @param \Box\Spout\Writer\Style\Style $style Style to be applied to the row. NULL means use default style.
     * @return void
     * @throws \Box\Spout\Common\Exception\IOException If the data cannot be written
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException If a cell value's type is not supported
     */
    protected function addNonEmptyRow($dataRow, $style)
    {
        $cellNumber = 0;
        $rowIndex = $this->lastWrittenRowIndex + 1;
        $numCells = count($dataRow);

        $rowXML = '<row r="' . $rowIndex . '" spans="1:' . $numCells . '">';

        foreach($dataRow as $key => $cellValue) {
        	$rowXML .= $this->getCellXML($rowIndex, $cellNumber, $cellValue, $style->getId(), $key);
            $cellNumber++;
        }

        $rowXML .= '</row>';

        $wasWriteSuccessful = fwrite($this->sheetFilePointer, $rowXML);
        if ($wasWriteSuccessful === false) {
            throw new IOException("Unable to write data in {$this->worksheetFilePath}");
        }
    }

    /**
     * Build and return xml for a single cell.
     *
     * @param int $rowIndex
     * @param int $cellNumber
     * @param mixed $cellValue
     * @param int $styleId
     * @return string
     * @throws InvalidArgumentException If the given value cannot be processed
     */
    protected function getCellXML($rowIndex, $cellNumber, $cellValue, $styleId, $key)
    {
        $columnIndex = CellHelper::getCellIndexFromColumnIndex($cellNumber);
        if($this->mergeCells[$key]){
        	$cellXML = '<c r="' . $key . '"';
        } else {
        	$cellXML = '<c r="' . $columnIndex . $rowIndex . '"';
        }
        $cellXML .= ' s="' . $styleId . '"';
		
		if (CellHelper::isFormula($cellValue)) {
            $cellXML .= '><f>' . $cellValue . '</f></c>';
        }else if (CellHelper::isNonEmptyString($cellValue)) {
            $cellXML .= $this->getCellXMLFragmentForNonEmptyString($cellValue);
        } else if (CellHelper::isBoolean($cellValue)) {
            $cellXML .= ' t="b"><v>' . intval($cellValue) . '</v></c>';
        } else if (CellHelper::isNumeric($cellValue)) {
            $cellXML .= '><v>' . $cellValue . '</v></c>';
        } else if (empty($cellValue)) {
            if ($this->styleHelper->shouldApplyStyleOnEmptyCell($styleId)) {
                $cellXML .= '/>';
            } else {
                // don't write empty cells that do no need styling
                // NOTE: not appending to $cellXML is the right behavior!!
                $cellXML = '';
            }
        } else {
            throw new InvalidArgumentException('Trying to add a value with an unsupported type: ' . gettype($cellValue));
        }

        return $cellXML;
    }

    /**
     * Returns the XML fragment for a cell containing a non empty string
     *
     * @param string $cellValue The cell value
     * @return string The XML fragment representing the cell
     * @throws InvalidArgumentException If the string exceeds the maximum number of characters allowed per cell
     */
    protected function getCellXMLFragmentForNonEmptyString($cellValue)
    {
        if ($this->stringHelper->getStringLength($cellValue) > self::MAX_CHARACTERS_PER_CELL) {
            throw new InvalidArgumentException('Trying to add a value that exceeds the maximum number of characters allowed in a cell (32,767)');
        }

        if ($this->shouldUseInlineStrings) {
            $cellXMLFragment = ' t="inlineStr"><is><t>' . $this->stringsEscaper->escape($cellValue) . '</t></is></c>';
        } else {
            $sharedStringId = $this->sharedStringsHelper->writeString($cellValue);
            $cellXMLFragment = ' t="s"><v>' . $sharedStringId . '</v></c>';
        }

        return $cellXMLFragment;
    }

    /**
     * Closes the worksheet
     *
     * @return void
     */
    public function close()
    {
        if (!is_resource($this->sheetFilePointer)) {
            return;
        }

        fwrite($this->sheetFilePointer, '</sheetData>');
        if ($this->mergeCells) { 
        	fwrite($this->sheetFilePointer, '<mergeCells count="'.count($this->mergeCells).'">');
        	foreach($this->mergeCells as $k => $v){
        		fwrite($this->sheetFilePointer, '<mergeCell ref="'.$v.'"/>');
        	}
        	fwrite($this->sheetFilePointer, '</mergeCells>');
        }
        
        fwrite($this->sheetFilePointer, '</worksheet>');
        fclose($this->sheetFilePointer);
    }
}
