function select(ch,verse) {
    verse = parseInt(verse);
    
    var box = document.getElementById("ch-"+ch+"-v-"+verse);
    //var number = document.getElementById("number-"+verse);
    
    
    // if any verse in current chapter has been selected
    if (selected[ch] != null) {
        // if this verse has been selected
        var inList = false;
        for (i in selected[ch]) {
            //console.log(selected[ch][i]);
            if (selected[ch][i] == verse) {
                inList = true;
            }
        }
        
        
        if (inList) {
            // remove this verse from list of selected
            var removedList = []
            for (i in selected[ch]) {
                //console.log(selected[ch][i]);
                if (selected[ch][i] != verse) {
                    removedList.push(selected[ch][i]);
                }
            }
            //console.log(removedList);
            
            selected[ch] = [];
            for (i in removedList) {
                selected[ch].push(removedList[i]);
            }
            
            if(ch == chapter) {
                box.className = box.className.replace(" verse-selected", "");
            }
            
        }
        else {
            //console.log('verse-not-in-list');
            selected[ch].push(verse);
            
            if(ch == chapter) {
                box.className += " verse-selected";
            }
        }
        
    } 
    // if this verse has never been selected
    else {
        selected[ch] = [verse];
        if(ch == chapter) {
            box.className += " verse-selected";
        }
    }
    

    
    
    
    /*
    
    // print out selected list (not ordered)
    console.log("Selected List");
    for (a in selected) {
        console.log("     " + a + ": " + selected[a]);
    }
    
    */
    
    
    
    add_cart();
    
    
    if(ch == chapter) {
        // check if the whole chapter is selected
        if (cart.items[chapter].length == verses.length) {
            document.getElementById('select-all').setAttribute('checked', 'true');
        } else {
            document.getElementById('div-select-all').innerHTML = '<span class="desktop">Click the verse number you want to adopt or </span><input id="select-all" class="checkbox-custom" name="select-all" type="checkbox" onclick="select_all(this.checked)"><label for="select-all" class="checkbox-custom-label">Select All</label>';
        }
    }
    
}


function select_all(checked) {
    if (checked) {
        selected[chapter] = [];
        for (i in verses) {
            selected[chapter].push(verses[i]);
            var box = document.getElementById("ch-"+chapter+"-v-"+verses[i]);
            box.className = box.className.replace(" verse-selected", "");
            box.className += " verse-selected";
        }
    } else {
        selected[chapter] = [];
        for (i in verses) {
            var box = document.getElementById("ch-"+chapter+"-v-"+verses[i]);
            box.className = box.className.replace(" verse-selected", "");
        }
    }
    
    /*
    
    // print out selected list (not ordered)
    console.log("Selected List");
    for (a in selected) {
        console.log("     " + a + ": " + selected[a]);
    }
    
    */
    
    add_cart();
}


function add_cart() {
    
    function sortNumber(a,b) {
        return a - b;
    }
    
    // sort selected items
    var sorted = [];
    for(var key in selected) {
        sorted[sorted.length] = key;
    }
    sorted.sort();

    var items = {};
    for(var i = 0; i < sorted.length; i++) {
        items[sorted[i]] = selected[sorted[i]].sort(sortNumber);
    }
    
    
    console.log("Items");
    for (a in items) {
        console.log("     " + a + ": " + items[a]);
    }
    
    
    // put items in cart on page
    //document.getElementById('div-cart').innerHTML = "";
    //document.getElementById('checkout').className = document.getElementById('checkout').className.replace(" empty", "");
    //document.getElementById('checkout').className += " empty";
    //document.getElementById('div-cart').style.display = 'none';
    //document.getElementById('div-cart-label').innerHTML = '&nbsp;';
    //document.getElementById('div-cart-label').className = 'no-label';
    //document.getElementById('div-cart-empty').style.display = 'block';
    
    // for mobile
    document.getElementById('div-cart-mobile').innerHTML = "";
    document.getElementById('mobile-cart').style.display = "none";
    
    // for tablet 
    document.getElementById('small-div-cart').innerHTML = "";
    document.getElementById('small-checkout').className = document.getElementById('small-checkout').className.replace(" empty", "");
    document.getElementById('small-checkout').className += " empty";
    document.getElementById('small-div-cart').style.display = 'none';
    document.getElementById('small-div-cart-label').innerHTML = '&nbsp;';
    document.getElementById('small-div-cart-label').className = 'no-label';
    document.getElementById('small-div-cart-empty').style.display = 'block';
    
    
    var count = 0;
    for (b in items) {
        for (c in items[b]) {
            //document.getElementById('div-cart').style.display = 'grid';
            //document.getElementById('div-cart-label').style.display = 'block';
            //document.getElementById('checkout').className = //document.getElementById('checkout').className.replace(" empty", "");
            //document.getElementById('div-cart-empty').style.display = 'none';
            //document.getElementById('div-cart').innerHTML += "<div class='item border--round' onmouseover='show_unselect("+b+","+items[b][c]+")' onmouseout='hide_unselect("+b+","+items[b][c]+")'>"+ book + " " + b + ":" + items[b][c] + "<img alt='' src='img/item_close.png' class='unselect' id='unselect-"+b+"-"+items[b][c]+"' onclick='select("+b+","+items[b][c]+")' /></div>";
            count ++;
            
            document.getElementById('mobile-cart').style.display = "block";
            document.getElementById('div-cart-mobile').innerHTML += "<div class='div-item'><div class='item border--round'>"+ book + " " + b + ":" + items[b][c] + "<img alt='' src='img/item_close.png' class='unselect-mobile' onclick='select("+b+","+items[b][c]+")' /></div></div>";
            
            document.getElementById('small-div-cart').style.display = 'block';
            document.getElementById('small-div-cart-label').style.display = 'block';
            document.getElementById('small-checkout').className = document.getElementById('small-checkout').className.replace(" empty", "");
            document.getElementById('small-div-cart-empty').style.display = 'none';
            document.getElementById('small-div-cart').innerHTML += "<div class='div-item'><div class='item border--round' onmouseover='show_unselect("+b+","+items[b][c]+")' onmouseout='hide_unselect("+b+","+items[b][c]+")'>"+ book[0] + book[1] + book[2] + ". " + b + ":" + items[b][c] + "<img alt='' src='img/item_close.png' class='small-unselect' id='small-unselect-"+b+"-"+items[b][c]+"' onclick='select("+b+","+items[b][c]+")' /></div></div>";
        }
    }
    
    
    
    // calculate the total price
    var total = count * verse_price;
    //document.getElementById('checkout').innerHTML = "Give $"+total;
    document.getElementById('checkout-mobile').innerHTML = "Give $"+total;
    document.getElementById('small-checkout').innerHTML = "Give $"+total;
    
    
    if (count == 1) {
        //document.getElementById('div-cart-label').className = '';
        //document.getElementById('div-cart-label').innerHTML = "<span class='highlight'>" + count + "</span> verse selected <div id='empty-cart' onclick='empty_cart()'>Empty Cart</div>";
        
        document.getElementById('cart-label').innerHTML = "<span class='label-title'>CART</span><br><span class='highlight'>" + count + "</span> verse selected";
        
        document.getElementById('small-div-cart-label').className = '';
        document.getElementById('small-div-cart-label').innerHTML = "<span class='highlight'>" + count + "</span> verse selected <div id='empty-cart' onclick='empty_cart()'>Empty Cart</div>";
        
        if (small_cart == false) {
            toggle_small_cart();
        }
        
        num_items = count + " verse";
        document.getElementById('num-items').innerHTML = num_items;
        
    } else if (count != 0) {
        //document.getElementById('div-cart-label').className = '';
        //document.getElementById('div-cart-label').innerHTML = "<span class='highlight'>" + count + "</span> verses selected <div id='empty-cart' onclick='empty_cart()'>Empty Cart</div>";
        
        document.getElementById('cart-label').innerHTML = "<span class='label-title'>CART</span><br><span class='highlight'>" + count + "</span> verses selected";
        
        document.getElementById('small-div-cart-label').className = '';
        document.getElementById('small-div-cart-label').innerHTML = "<span class='highlight'>" + count + "</span> verses selected <div id='empty-cart' onclick='empty_cart()'>Empty Cart</div>";
        
        document.getElementById('mobile-cart').style.display = "block";

        if (small_cart == false) {
            toggle_small_cart();
        }
        
        num_items = count + " verses";
        document.getElementById('num-items').innerHTML = num_items;
    } else if (count == 0) {
        document.getElementById('mobile-cart').style.display = "none";
        
        num_items = 0;
        document.getElementById('num-items').style.display = 'none';
    }
    
        
    
    // update cart object
    cart.items = items;
    cart.price = total;
    cart.total = count;
    
    //console.log(cart);
    
}


function show_unselect(ch,v) {
    
    // display unselect button when hovered over
    //document.getElementById('unselect-'+ch+'-'+v).style.display = "block";
    document.getElementById('small-unselect-'+ch+'-'+v).style.display = "block";
}

function hide_unselect(ch,v) {
    
    // hide unselect button when mouse is out
    //document.getElementById('unselect-'+ch+'-'+v).style.display = "none";
    document.getElementById('small-unselect-'+ch+'-'+v).style.display = "none";
}

function empty_cart() {
    
    if (window.confirm("Would you like to empty your cart?")) {
        // reset everything
        selected = {};
        num_items = 0;
        cart = {};

        // unselect everything
        select_all(false);

        // uncheck select-all checkbox
        document.getElementById('div-select-all').innerHTML = '<span class="desktop">Click the verse number you want to adopt or </span><input id="select-all" class="checkbox-custom" name="select-all" type="checkbox" onclick="select_all(this.checked)"><label for="select-all" class="checkbox-custom-label">Select All</label>';
    }
    
}