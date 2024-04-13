////////// Globale Variablen //////////
var events = [];
var site = 1;
var max_page = 1;
var oldSite = 0;
///////////////////////////////////////

// Konstruktor
class event {
    constructor(title, text, group, link, image, w_by, date, link_name) {
        this.title = title;
        this.text = text;
        this.group = group;
        this.link = link;
        this.image = image;
        this.w_by = w_by;
        this.date = date;
        this.link_name = link_name;
    }

    getTitle() {
        return this.title;
    }

    getText() {
        return this.text;
    }

    getGroup() {
        return this.group;
    }

    getLink() {
        return this.link;
    }

    getImage() {
        return this.image;
    }

    getW_by() {
        return this.w_by;
    }

    getDate() {
        return this.date;
    }

    getLink_name() {
        return this.link_name;
    }
}

function getNews(number) {
    //$.removeClass("active");
    $(".zahl" + oldSite).removeClass("active");
    site = number;
    oldSite = number;
    events = [];
    console.log (site);
    $.ajax({
        type: "GET",
        url: "/source/php/getNews.php?new=0&quantity=" + number + "&timestamp=0",
        datatype: "json",
        success: function(data) {
            data = JSON.parse(data);
            if(data != false){    
                $.each(data, function(index, element) {
                    temp = new event(element['titel'], element['inhalt'], element['gruppe'], element['link'], element['bild'], element['erstellt_von'], element['erstellt'], element['link_name']);
                    events.push(temp);
                });
                console.log (events);
                onNewDataArchiv();
                $(".zahl" + site).addClass("active");
            }
        }
    })
}   

function nextPage() {
    if (site < max_page) {
        site++;
        getNews(site);
    }
}

function previousPage() {
    if (site > 1) {
        site--;
        getNews(site);
    }
}

//Starter für Funktionen
$(document).ready(function() {
    console.log("ready!");
    getNews(1);
    setMaxPages();
});
