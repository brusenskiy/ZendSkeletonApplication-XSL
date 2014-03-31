<?xml version="1.0"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output
        method="html"
        omit-xml-declaration="yes"
    />

    <xsl:template match="/">
        <xsl:apply-templates select="view" />
    </xsl:template>

    <xsl:template match="view">
        test content goes here:
        <hr />
        <xsl:apply-templates />
    </xsl:template>

    <xsl:template match="date">
        <i><xsl:value-of select="date/human" /></i>
    </xsl:template>

    <xsl:template match="message">
        <div style="color: orange;">
            <xsl:value-of select="text()" />
        </div>
    </xsl:template>
</xsl:stylesheet>
