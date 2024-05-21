function getLatestTimestamp () {
    var time = new Date,
    timestamp = [time.getFullYear(),
                time.getMonth()+1,
                time.getDate()].join('-')+' '+
                [time.getHours(),
                time.getMinutes(),
                time.getSeconds()].join(':')+
                [".000000"];
    return timestamp;
}

// Funktion zum Erzeugen der News auf der Home-Page
function onNewData() {
    // Erstelle einen neuen Container #updated_news
    var updatedNewsContainer = $('<div id="updated_news"><h1 class="over_headline">News</h1></div><br><br>');
    
    // Lösche den vorhandenen Inhalt von #news
    $('#news').empty();
    
    
    $.each(events, function(index, event) {
        var sections = event.text.split('\n');
        
        // Erstelle einen neuen textblock für jedes Event
        var textblock = $('<div class="textblock"></div>');
        
        // Füge den Titel als Überschrift hinzu
        var headline = $('<div class="headline"><h2>' + event.title + '</h2></div>');
        textblock.append(headline);
        
        // Füge die Abschnitte als .section hinzu
        $.each(sections, function(index, sectionText) {
            if (sectionText.trim() !== '') { // Überspringe leere Abschnitte
                var section = $('<div class="section"><p>' + sectionText + '</p></div>');
                textblock.append(section);
            }
        });
        
        // Füge die Links ein, falls vorhanden
        if (event.link !== null) {
            var links = event.link.split('-__-__-__-'); // Trenne die Links
            var linkNames = event.link_name.split('-__-__-__-'); // Trenne die Link-Namen
            
            $.each(links, function(index, link) {
                if (link !== '') { // Stelle sicher, dass der Link nicht leer ist
                    var linkName = linkNames[index];
                    var mainLink = $('<div class="main-link"><li><a class="sec-link" href="/source/php/ext_link.php?ziel=' + link + '&name=' + linkName + '">' + linkName + '</a></li></div>');
                    textblock.append(mainLink);
                }
            });
        }

        // Füge den footer ein
        // Kovertiere event.date von YYYY-MM-DD HH:MM:SS zu DD.MM.YYYY
        var date = event.date.slice(8, 10) + '.' + event.date.slice(5, 7) + '.' + event.date.slice(0, 4);
        var footer = $('<br><br><div class="footerNews"><p>Erstellt am: ' + date + ' | von: ' + event.w_by + '</p></div>');
        textblock.append(footer);
        
        // Füge den textblock in den #updated_news-Bereich ein
        updatedNewsContainer.append(textblock);
    });
    
    // Ersetze den alten #news-Container durch den neuen #updated_news-Container
    $('#news').replaceWith(updatedNewsContainer);
}

// Funktion zum Erzeugen der News auf der Archiv-Page
function onNewDataArchiv() {
    // Erstelle einen neuen Container #updated_news
    var updatedNewsContainer = $('<div id="news"></div>');
    
    // Lösche den vorhandenen Inhalt von #news
    $('#news').empty();
    
    
    $.each(events, function(index, event) {
        var sections = event.text.split('\n');
        
        // Erstelle einen neuen textblock für jedes Event
        var textblock = $('<div class="textblock"></div>');
        
        // Füge den Titel als Überschrift hinzu
        var headline = $('<div class="headline"><h2>' + event.title + '</h2></div>');
        textblock.append(headline);
        
        // Füge die Abschnitte als .section hinzu
        $.each(sections, function(index, sectionText) {
            if (sectionText.trim() !== '') { // Überspringe leere Abschnitte
                var section = $('<div class="section"><p>' + sectionText + '</p></div>');
                textblock.append(section);
            }
        });
        
        // Füge die Links ein, falls vorhanden
        if (event.link !== null) {
            var links = event.link.split('-__-__-__-'); // Trenne die Links
            var linkNames = event.link_name.split('-__-__-__-'); // Trenne die Link-Namen
            
            $.each(links, function(index, link) {
                if (link !== '') { // Stelle sicher, dass der Link nicht leer ist
                    var linkName = linkNames[index];
                    var mainLink = $('<div class="main-link"><li><a class="sec-link" href="/source/php/ext_link.php?ziel=' + link + '&name=' + linkName + '">' + linkName + '</a></li></div>');
                    textblock.append(mainLink);
                }
            });
        }

        // Füge den footer ein
        // Kovertiere event.date von YYYY-MM-DD HH:MM:SS zu DD.MM.YYYY
        var date = event.date.slice(8, 10) + '.' + event.date.slice(5, 7) + '.' + event.date.slice(0, 4);
        var footer = $('<br><br><div class="footerNews"><p>Erstellt am: ' + date + ' | von: ' + event.w_by + '</p></div>');
        textblock.append(footer);
        
        // Füge den textblock in den #updated_news-Bereich ein
        updatedNewsContainer.append(textblock);
    });
    
    // Ersetze den alten #news-Container durch den neuen #updated_news-Container
    $('#news').replaceWith(updatedNewsContainer);
}

// Funktion zum Erzeugen der Zahlen in der News-Liste
function setCounter() {
    var $zahlContainer = $('.zaehler .zurueck'); // Container für Zahlen. hinter welchem Container sollen die Zahlen generiert werden?
    var counterValue = parseInt(counter); // Wert des Zählers

    // Schleife zum Hinzufügen der neuen Zahlen
    for (var i = counterValue; i > 0; i--) {
        console.log (i);
        var $newZahl = $('<div class="zahl zahl' + i + '" onclick="getNews(' + i + ')"><p>' + i + '</p></div>');
        $zahlContainer.after($newZahl);
    }
}

// Gibt die maximale Seitenzahl zurück
function setMaxPages() {
    $.ajax({
        type: "GET",
        url: "/source/php/getNewsCounter.php",
        datatype: "json",
        success: function(data) {
            data = JSON.parse(data);
            if(data != false){ 
                max_page = data;
            }

        },
    });
}

