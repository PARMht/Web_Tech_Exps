<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
  <html>
  <head>
    <title>Student Directory</title>
    <style>
      body { font-family: Arial, sans-serif; }
      table { border-collapse: collapse; width: 60%; margin-top: 20px; }
      th, td { border: 1px solid #dddddd; padding: 12px; text-align: left; }
      th { background-color: #4CAF50; color: white; }
    </style>
  </head>
  <body>
    <h2>Engineering Student Directory</h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Department</th>
        <th>Year</th>
      </tr>
      <xsl:for-each select="students/student">
        <tr>
          <td><xsl:value-of select="@id"/></td>
          <td><xsl:value-of select="name"/></td>
          <td><xsl:value-of select="department"/></td>
          <td><xsl:value-of select="year"/></td>
        </tr>
      </xsl:for-each>
    </table>
  </body>
  </html>
</xsl:template>
</xsl:stylesheet>