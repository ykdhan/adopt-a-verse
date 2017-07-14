// initialize global variables

var book = "";                  // book the church is sponsoring

var chapter = 0;                // current chapter
var max_chapter = 0;            // the last chapter

var verses = [];                // verses of current chapter
var max_verse = 0;              // the last verse

var selected = {};              // selected verses (not sorted)

var verse_price = 0;            // price of each verse

var total_adopted = 0;          // number of verses adopted
var total_verses = 0;           // number of total verses

var total_percentage = 0;       // percentage of current fund raised
var total_raised = 0;           // amount of total raised so far
var total_goal = 0;             // amount of total goal

var num_items = 0;              // number of verses in cart

var small_total = true;         // is total raised opened?
var small_cart = false;         // is cart opened?
var small_language = true;      // is language group details opened?
var small_photo = false;        // is photo opened?


// objects

var church = {};
var cart = {};
var bible = {};



// mobile

var menu = false;               // is mobile menu opened?
var cart = false;               // is mobile cart opened?
var original_cart_height = 0;        // original height of mobile cart
var original_menu_height = 0;        // original height of mobile menu
