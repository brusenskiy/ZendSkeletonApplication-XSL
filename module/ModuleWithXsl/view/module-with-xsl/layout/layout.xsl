<?xml version="1.0"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output
        method="html"
        indent="no"
        encoding="utf-8"
        doctype-system="about:legacy-compat"
    />

    <xsl:template match="layout"><html>
        <head />
        <body>
            <xsl:value-of select="content" disable-output-escaping="yes" />
        </body>
    </html></xsl:template>
</xsl:stylesheet>
