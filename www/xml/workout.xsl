<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" indent="yes" />
    <xsl:template match="/plan">
        <div class="font-sans m-4">
            <h2 class="text-3xl font-bold mb-4 text-blue-600"><xsl:value-of select="nazev" /></h2>
            <p class="text-lg text-gray-700 mb-2"><xsl:value-of select="popis" /></p>
            <p class="text-xl text-gray-800 mb-4"><strong>Cíl: </strong> <xsl:value-of select="cil" /></p>
            <xsl:for-each select="workout">
                <div class="border border-gray-300 rounded-lg shadow-lg m-2 p-4 bg-white">
                    <button class="accordion text-2xl font-semibold text-blue-500 mb-2 focus:outline-none flex justify-between items-center" onclick="toggleAccordion(this)">
                        <span><xsl:value-of select="nazev" /></span>
                        <svg class="w-6 h-6 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="panel hidden">
                        <p class="text-md text-gray-600 mb-2"><xsl:value-of select="popis" /></p>
                        <p class="text-md text-gray-600 mb-2"><strong>Trvání: </strong> <xsl:value-of select="trvani" /> min.</p>
                        <h4 class="text-xl font-medium text-gray-700 mt-4 mb-2">Cviky:</h4>
                        <xsl:for-each select="cviky/cvik">
                            <div class="ml-5 mb-4 p-2 border-l-4 border-blue-200">
                                <p class="text-md text-gray-800"><strong>Cvik: </strong> <xsl:value-of select="nazev" /></p>
                                <p class="text-md text-gray-800"><strong>Série: </strong> <xsl:value-of select="sety" />x</p>
                                <p class="text-md text-gray-800"><strong>Opakování: </strong> <xsl:value-of select="repy" />x</p>
                                <p class="text-md text-gray-800"><strong>Odpočinek: </strong> <xsl:value-of select="odpocinek" /> min.</p>
                            </div>
                        </xsl:for-each>
                    </div>
                </div>
            </xsl:for-each>
        </div>
    </xsl:template>
</xsl:stylesheet>

