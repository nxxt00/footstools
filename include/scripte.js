// script kd
// diese sich oeffnenden fenster passen sich an die jeweilige bildgroesse an,
// das erspart das anlegen von etlichen 'window.open' functionen
function GrafikAnzeigen(GrafikURL, Breite, Hoehe)
{
    Fensteroptionen = "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,top=50, left=80";

    Grafikfenster = window.open("", "", Fensteroptionen + ',width=' + Breite + ',height=' + Hoehe);
    Grafikfenster.focus();
    Grafikfenster.document.open();

    with(Grafikfenster)
    {
        document.write("<html><head>");
        document.write("<title>Footstools - Stoffe</title>");
        document.write("</head>");
        document.write("<body leftmargin=\"0\" marginheight=\"0\" marginwidth=\"0\" topmargin=\"0\">");
        document.write("<img border=\"0\" onclick=\"window.close();\" src=\""+ GrafikURL +"\" title=\"Zum Schlie&szlig;en auf das Foto klicken\">");
        document.write("</body></html>");
    }

    return;
}

//---------------

//function fensterdemo0()
//{
//window.open ("bilder1.html","","status=1,scrollbars=0,resizable=no,menubar=no,toolbar=no,location=no,width=196,height=710,top=25,left=40");
// }
