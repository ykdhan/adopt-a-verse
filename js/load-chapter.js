
// show chapter select box
function show_chapters() {
    if (document.getElementById('select-chapter').style.display == "inherit") {
        document.getElementById('select-chapter').style.display = "none";
        document.getElementById('button-chapter').style.backgroundColor = '#fff';
    } else {
        document.getElementById('select-chapter').style.display = "inherit";
        document.getElementById('button-chapter').style.backgroundColor = '#eaeaea';
    }
}
    

// hide chapter select box
function hide_chapters() {
    document.getElementById('select-chapter').style.display = "none";
    document.getElementById('button-chapter').style.backgroundColor = '#fff';
}

    
// load book of the Bible
function load_book (bk) {
    book = bk;
    document.getElementById('book').innerHTML = book;
    
    fill_chapters(max_chapter);
    
    chapter = 1;
    
    load_chapter(book,chapter);
}

    
// load Bible from json file
function load_chapter (bk,ch) {
    verses = [];
    max_verse = 0;
    var all_selected = true;
    
    fill_chapters(max_chapter);
    
    // update current book and chapter
    document.getElementById('button-chapter').innerHTML = book + " " + chapter + "<img alt='' src='img/cart_close.png' />";
    
    // load verses
    
    document.getElementById('bible').innerHTML = "";
    
    //console.log(bible);
    
    for (verse in bible[ch]) {

        var in_cart = false;

        // see if verses are already selected
        if (chapter in selected) {
            for (i in selected[chapter]) {
                if (selected[chapter][i] == verse) {
                    in_cart = true;
                    //console.log(item.chapter + ":" + item.verse);
                }
            }
        }

        var build = "";

        // if verse is already selected
        if (in_cart) {
            build += '<div class="verse verse-selected" id="ch-'+chapter+'-v-'+verse+'" onclick="select('+ch+','+parseInt(verse)+')">';
            build += '<div class="verse-number" id="number-'+verse+'"><div>'+verse+'</div></div>';
            build += '<div class="verse-content"><div>'+bible[ch][verse]+'</div></div>';
            build += "</div>";
        }
        // if verse is not selected
        else {
            build += '<div class="verse" id="ch-'+chapter+'-v-'+verse+'" onclick="select('+ch+','+parseInt(verse)+')">';
            build += '<div class="verse-number" id="number-'+verse+'"><div>'+verse+'</div></div>';
            build += '<div class="verse-content"><div>'+bible[ch][verse]+'</div></div>';
            build += "</div>";

            all_selected = false;
        }

        $('#bible').append(build);

        // add to possible verses in current chapter
        verses.push(parseInt(verse));

        // get the last verse number
        max_verse = parseInt(verse);
    }


    // if all verses have been selected 
    if (all_selected) {
        document.getElementById('div-select-all').innerHTML = '<span class="desktop">Click the verse number you want to adopt or </span><input id="select-all" class="checkbox-custom" name="select-all" type="checkbox" onclick="select_all(this.checked)"><label for="select-all" class="checkbox-custom-label">Select All</label>';
        document.getElementById('select-all').setAttribute('checked', 'true');
    } else {
        document.getElementById('div-select-all').innerHTML = '<span class="desktop">Click the verse number you want to adopt or </span><input id="select-all" class="checkbox-custom" name="select-all" type="checkbox" onclick="select_all(this.checked)"><label for="select-all" class="checkbox-custom-label">Select All</label>';
    }


    console.log("Status  ---  "+book+"("+max_chapter+")  Ch: "+chapter+"("+max_verse+")");
   
}
    

// fill the chapters of the book
function fill_chapters(num){
    
    max_chapter = num;
    
    var chapters = document.getElementById('chapters');
    chapters.innerHTML = "";
    
    for (var i = 1; i <= max_chapter; i++) {
        if (i == chapter) {
            chapters.innerHTML += '<div class="chapter-now">'+i+'</div>';
        } else {
            chapters.innerHTML += '<div onclick="change_chapter('+i+')">'+i+'</div>';  
        }
    }
}
    

// when change chapter
function change_chapter(num) {
    chapter = num;
    load_chapter(book,chapter);
    hide_chapters();
}
    