<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" indent="yes" />
    <xsl:template match="/">
        <div class="font-sans m-4">
            <h1 class="text-3xl font-bold underline mb-4">Cvičební programy</h1>
            <xsl:for-each select="workout">
                <div class="border border-gray-300 m-2 p-2">
                    <h2 class="text-2xl"><xsl:value-of select="nazev" /></h2>
                    <p><xsl:value-of select="popis" /></p>
                    <h3 class="text-xl mt-2">Cviky:</h3>
                    <xsl:for-each select="cviky/cvik">
                        <div class="ml-5">
                            <strong>Cvik:</strong> <xsl:value-of select="nazev" /><br />
                            <h4 class="text-lg mt-1">Série:</h4>
                            <xsl:for-each select="sety/set">
                                <div class="ml-10">
                                    <strong>Váha:</strong> <xsl:value-of select="vaha" />Kg<br />
                                    <strong>Počet opakování:</strong> <xsl:value-of select="opak" /><br />
                                </div>
                            </xsl:for-each>
                        </div>
                    </xsl:for-each>
                </div>
            </xsl:for-each>
        </div>
    </xsl:template>
</xsl:stylesheet>

