<?php

class TikaWrapperTest extends PHPUnit_Framework_TestCase {

    public function testGetWordCount() {
        $sampleFile1 = test_files_path() . 'sample1.txt';
        $wordCount = TikaWrapper::getWordCount($sampleFile1);
        $this->assertEquals(17 , $wordCount);
    }

    public function testGetXML() {
        $sampleFile1 = test_files_path() . 'sample1.txt';
        $xml = TikaWrapper::getXHTML($sampleFile1);
        $xmlLines = preg_split('/\n/', $xml);
        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><html xmlns="http://www.w3.org/1999/xhtml">', trim($xmlLines[0]));
        $this->assertEquals('<head>', trim($xmlLines[1]));
        $this->assertEquals('<meta name="Content-Length" content="119"/>', trim($xmlLines[2]));
        $this->assertEquals('<meta name="Content-Encoding" content="ISO-8859-1"/>', trim($xmlLines[3]));
        $this->assertEquals('<meta name="Content-Type" content="text/plain; charset=ISO-8859-1"/>', trim($xmlLines[4]));
        $this->assertEquals('<meta name="resourceName" content="sample1.txt"/>', trim($xmlLines[5]));
        $this->assertEquals('<title/>', trim($xmlLines[6]));
        $this->assertEquals('</head>', trim($xmlLines[7]));
        $this->assertEquals('<body><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam blandit blandit augue, eu tristique arcu tincidunt et.</p>', trim($xmlLines[8]));
        $this->assertEquals('</body></html>', trim($xmlLines[9]));
    }

    public function testGetHTML() {
        $sampleFile1 = test_files_path() . 'sample1.txt';
        $xml = TikaWrapper::getHTML($sampleFile1);
        $xmlLines = preg_split('/\n/', $xml);
        $this->assertEquals('<html xmlns="http://www.w3.org/1999/xhtml">', trim($xmlLines[0]));
        $this->assertEquals('<head>', trim($xmlLines[1]));
        $this->assertEquals('<meta name="Content-Length" content="119"/>', trim($xmlLines[2]));
        $this->assertEquals('<meta name="Content-Encoding" content="ISO-8859-1"/>', trim($xmlLines[3]));
        $this->assertEquals('<meta name="Content-Type" content="text/plain; charset=ISO-8859-1"/>', trim($xmlLines[4]));
        $this->assertEquals('<meta name="resourceName" content="sample1.txt"/>', trim($xmlLines[5]));
        $this->assertEquals('<title></title>', trim($xmlLines[6]));
        $this->assertEquals('</head>', trim($xmlLines[7]));
        $this->assertEquals('<body><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam blandit blandit augue, eu tristique arcu tincidunt et.</p>', trim($xmlLines[8]));
        $this->assertEquals('</body></html>', trim($xmlLines[9]));
    }

    public function testGetText() {
        $sampleFile1 = test_files_path() . 'sample1.txt';
        $text = trim(TikaWrapper::getText($sampleFile1));
        $this->assertEquals('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam blandit blandit augue, eu tristique arcu tincidunt et.', $text);
    }

    public function testGetTextMain() {
        $sampleFile1 = test_files_path() . 'sample1.html';
        $textMain = trim(TikaWrapper::getTextMain($sampleFile1));
        $this->assertEquals('Some titleAliquam blandit blandit augue, eu tristique arcu tincidunt et.', $textMain);
    }

    public function testGetMetadata() {
        $sampleFile1 = test_files_path() . 'sample1.html';
        $metadata = trim(TikaWrapper::getMetadata($sampleFile1));
        $metadataLines = preg_split('/\n/', $metadata);
        $this->assertEquals('Content-Encoding: ISO-8859-1', trim($metadataLines[0]));
        $this->assertEquals('Content-Length: 119', trim($metadataLines[1]));
        $this->assertEquals('Content-Type: text/plain; charset=ISO-8859-1', trim($metadataLines[2]));
        $this->assertEquals('dc:title: Some title', trim($metadataLines[3]));
        $this->assertEquals('resourceName: sample1.txt', trim($metadataLines[4]));
        $this->assertEquals('title: Some title', trim($metadataLines[5]));
    }

    public function testGetJson() {
        $sampleFile1 = test_files_path() . 'sample1.html';
        $json = trim(TikaWrapper::getJson($sampleFile1));
        $jsonLines = preg_split('/\n/', $json);
        $this->assertEquals('{ "Content-Encoding":"ISO-8859-1",', trim($jsonLines[0]));
        $this->assertEquals('"Content-Length":119,', trim($jsonLines[1]));
        $this->assertEquals('"Content-Type":"text/plain; charset\u003dISO-8859-1",', trim($jsonLines[2]));
        $this->assertEquals('"dc:title":"Some title",', trim($jsonLines[3]));
        $this->assertEquals('"resourceName":"sample1.txt",', trim($jsonLines[4]));
        $this->assertEquals('"title":"Some title" }', trim($jsonLines[5]));
    }

    public function testGetXmp() {
        $sampleFile1 = test_files_path() . 'sample1.html';
        $xmp = trim(TikaWrapper::getXmp($sampleFile1));
        $xmpLines = preg_split('/\n/', $xmp);
        $this->assertEquals('<x:xmpmeta xmlns:x="adobe:ns:meta/" x:xmptk="Adobe XMP Core 5.1.0-jc003">', trim($xmpLines[0]));
        $this->assertEquals('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">', trim($xmpLines[1]));
        $this->assertEquals('<rdf:Description rdf:about=""', trim($xmpLines[2]));
        $this->assertEquals('xmlns:dc="http://purl.org/dc/elements/1.1/">', trim($xmpLines[3]));
        $this->assertEquals('<dc:title>', trim($xmpLines[4]));
        $this->assertEquals('<rdf:Alt>', trim($xmpLines[5]));
        $this->assertEquals('<rdf:li xml:lang="x-default">Some title</rdf:li>', trim($xmpLines[6]));
        $this->assertEquals('</rdf:Alt>', trim($xmpLines[7]));
        $this->assertEquals('</dc:title>', trim($xmpLines[8]));
        $this->assertEquals('</rdf:Description>', trim($xmpLines[9]));
        $this->assertEquals('</rdf:RDF>', trim($xmpLines[10]));
        $this->assertEquals('</x:xmpmeta>', trim($xmpLines[11]));
    }

    public function testGetLanguage() {
        $sampleFile1 = test_files_path() . 'sample1.pdf';
        $sampleFile2 = test_files_path() . 'sample1.html';
        $sampleFile3 = test_files_path() . 'sample1.txt';
        $sampleFile4 = test_files_path() . 'test.odt';

        $language1 = trim(TikaWrapper::getLanguage($sampleFile1));
        $language1 = preg_replace('/\s+/', ' ', $language1);
        $language2 = trim(TikaWrapper::getLanguage($sampleFile2));
        $language3 = trim(TikaWrapper::getLanguage($sampleFile3));
        $language4 = trim(TikaWrapper::getLanguage($sampleFile4));
        $language4 = preg_replace('/\s+/', ' ', $language4);

        $this->assertEquals('en en', $language1);
        $this->assertEquals('lt', $language2);
        $this->assertEquals('lt', $language3);
        $this->assertEquals('en', $language4);
    }

    public function testGetDocumentType() {
        $sampleFile1 = test_files_path() . 'sample1.pdf';
        $sampleFile2 = test_files_path() . 'sample1.html';
        $sampleFile3 = test_files_path() . 'sample1.txt';
        $sampleFile4 = test_files_path() . 'test.odt';

        $docType1 = trim(TikaWrapper::getDocumentType($sampleFile1));
        $docType2 = trim(TikaWrapper::getDocumentType($sampleFile2));
        $docType3 = trim(TikaWrapper::getDocumentType($sampleFile3));
        $docType4 = trim(TikaWrapper::getDocumentType($sampleFile4));

        $this->assertEquals('application/pdf', $docType1);
        $this->assertEquals('application/xhtml+xml', $docType2);
        $this->assertEquals('text/plain', $docType3);
        $this->assertEquals('application/vnd.oasis.opendocument.text', $docType4);
    }

}