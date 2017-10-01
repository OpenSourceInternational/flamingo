<?php

namespace Flamingo\Processor\Writer;

use Flamingo\Core\Table;
use League\Csv\Writer as LCsvWriter;

/**
 * Class CsvWriter
 * @package Flamingo\Processor\Writer
 */
class CsvWriter extends AbstractFileWriter
{
    /**
     * @var array
     */
    protected $defaultOptions = [
        'delimiter' => ',',
        'enclosure' => '"',
        'escape' => '\\',
        'newline' => "\n",
    ];

    /**
     * @param Table $table
     * @param array $options
     * @return string
     */
    protected function tableContent(Table $table, array $options)
    {
        // Overwrite default options
        $options = array_replace($this->defaultOptions, $options);

        // Cast into array
        $data = $table->getArrayCopy();

        // Create writer
        $writer = LCsvWriter::createFromFileObject(new \SplTempFileObject());

        // Set up writer controls from options
        $writer->setDelimiter($options['delimiter']);
        $writer->setEnclosure($options['enclosure']);
        $writer->setEscape($options['escape']);
        $writer->setNewline($options['newline']);

        // Add header
        if (count($data)) {
            $writer->insertOne(array_keys(current($data)));
        }

        // Insert the data
        $writer->insertAll($data);

        // Return document content
        return $writer;
    }
}