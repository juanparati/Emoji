<?php

/**
 * Extract, parse and generates an unicode list
 * @link http://unicode.org/emoji/charts/full-emoji-list.html
 */
$export = [];

// Load document
libxml_use_internal_errors(true);

$dom = new DOMDocument();
$dom->loadHTMLFile('http://unicode.org/emoji/charts/full-emoji-list.html');

// Get the first table
$table = $dom->getElementsByTagName('table')->item(0);

// Iterate over the table rows
foreach ($table->getElementsByTagName('tr') as $row)
{

    $code = $name = null;

    // Iterate over each column
    $columns = $row->getElementsByTagName('td');

    if ($columns->length > 0)
    {

        foreach ($columns as $col)
        {

            $column_name = $col->getAttribute('class');

            if ($column_name == 'code')
            {

                $code = "";

                $rawcode = $col->getElementsByTagName('a')->item(0)->getAttribute('name');
                $rawcode = explode('_', $rawcode);

                if (count($rawcode) > 1)
                {
                    $code .= '[';

                    foreach ($rawcode as $k => $seq)
                    {
                        $code .= $k === 0 ? '' : ', ';
                        $code .= '0x' . $seq;
                    }

                    $code .= ']';
                }
                else
                    $code = '0x' . $rawcode[0];

                $code = strtoupper($code);

            }


            if ($column_name == 'name')
            {
                $name = strip_tags($col->nodeValue);

                $names = explode('≊', $name);

                if (count($names) > 1)
                    $name = mb_strlen($names[0]) > mb_strlen($names[1]) ? $names[1] : $names[0];

                $name = '"' . strtolower(trim($name)) . '"';

                echo $name;
                echo str_repeat(' ', 60 - mb_strlen($name));
                echo " => $code,";
                echo PHP_EOL;

                break;
            }

        }

    }

}



