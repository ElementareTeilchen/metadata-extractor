# Neos Meta Data Extractor Package
This package handles extraction of meta data from assets. 

**Note: This package is work in progress. The class structure and interfaces may change a lot over time. The package is not meant for productive use.**

The package provides the `ExtractorInterface`. Implementing classes provide the compatible media types and are called with the target assets. Returned DTOs are added to a collection and forwarded to the central `MetaDataManger` of package *Neos.MetaData*.

## Adapters
The `ExtractionManager` itself generates the `Asset` DTO for every valid Asset. 

### `InterventionImageAdapter` ([Intervention/Image](https://github.com/intervention/image))

#### Supported Media Types
* image/jpeg
* video/jpeg

#### Generated DTOs
* EXIF

### `IptcIimAdapter` ([IPTC IIM](https://iptc.org/standards/iim/))

#### Supported Media Types
* image/gif
* image/jpeg
* image/png
* application/x-shockwave-flash
* image/psd
* image/bmp
* image/tiff
* application/octet-stream
* image/jp2
* image/iff
* image/vnd.wap.wbmp
* image/xbm
* image/vnd.microsoft.icon

#### Generated DTOs
* IPTC