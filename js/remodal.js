!(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], function($) {
      return factory(root, $);
    });
  } else if (typeof exports === 'object') {
    factory(root, require('jquery'));
  } else {
    factory(root, root.jQuery || root.Zepto);
  }
})(this, function(global, $) {

  'use strict';

  /**
   * Name of the plugin
   * @private
   * @const
   * @type {String}
   */
  var PLUGIN_NAME = 'remodal';

  /**
   * Namespace for CSS and events
   * @private
   * @const
   * @type {String}
   */
  var NAMESPACE = global.REMODAL_GLOBALS && global.REMODAL_GLOBALS.NAMESPACE || PLUGIN_NAME;

  /**
   * Animationstart event with vendor prefixes
   * @private
   * @const
   * @type {String}
   */
  var ANIMATIONSTART_EVENTS = $.map(
    ['animationstart', 'webkitAnimationStart', 'MSAnimationStart', 'oAnimationStart'],

    function(eventName) {
      return eventName + '.' + NAMESPACE;
    }

  ).join(' ');

  /**
   * Animationend event with vendor prefixes
   * @private
   * @const
   * @type {String}
   */
  var ANIMATIONEND_EVENTS = $.map(
    ['animationend', 'webkitAnimationEnd', 'MSAnimationEnd', 'oAnimationEnd'],

    function(eventName) {
      return eventName + '.' + NAMESPACE;
    }

  ).join(' ');

  /**
   * Default settings
   * @private
   * @const
   * @type {Object}
   */
  var DEFAULTS = $.extend({
    hashTracking: true,
    closeOnConfirm: true,
    closeOnCancel: true,
    closeOnEscape: true,
    closeOnOutsideClick: true,
    modifier: '',
    appendTo: null
  }, global.REMODAL_GLOBALS && global.REMODAL_GLOBALS.DEFAULTS);

  /**
   * States of the Remodal
   * @private
   * @const
   * @enum {String}
   */
  var STATES = {
    CLOSING: 'closing',
    CLOSED: 'closed',
    OPENING: 'opening',
    OPENED: 'opened'
  };

  /**
   * Reasons of the state change.
   * @private
   * @const
   * @enum {String}
   */
  var STATE_CHANGE_REASONS = {
    CONFIRMATION: 'confirmation',
    CANCELLATION: 'cancellation'
  };

  /**
   * Is animation supported?
   * @private
   * @const
   * @type {Boolean}
   */
  var IS_ANIMATION = (function() {
    var style = document.createElement('div').style;

    return style.animationName !== undefined ||
      style.WebkitAnimationName !== undefined ||
      style.MozAnimationName !== undefined ||
      style.msAnimationName !== undefined ||
      style.OAnimationName !== undefined;
  })();

  /**
   * Is iOS?
   * @private
   * @const
   * @type {Boolean}
   */
  var IS_IOS = /iPad|iPhone|iPod/.test(navigator.platform);

  /**
   * Current modal
   * @private
   * @type {Remodal}
   */
  var current;

  /**
   * Scrollbar position
   * @private
   * @type {Number}
   */
  var scrollTop;

  /**
   * Returns an animation duration
   * @private
   * @param {jQuery} $elem
   * @returns {Number}
   */
  function getAnimationDuration($elem) {
    if (
      IS_ANIMATION &&
      $elem.css('animation-name') === 'none' &&
      $elem.css('-webkit-animation-name') === 'none' &&
      $elem.css('-moz-animation-name') === 'none' &&
      $elem.css('-o-animation-name') === 'none' &&
      $elem.css('-ms-animation-name') === 'none'
    ) {
      return 0;
    }

    var duration = $elem.css('animation-duration') ||
      $elem.css('-webkit-animation-duration') ||
      $elem.css('-moz-animation-duration') ||
      $elem.css('-o-animation-duration') ||
      $elem.css('-ms-animation-duration') ||
      '0s';

    var delay = $elem.css('animation-delay') ||
      $elem.css('-webkit-animation-delay') ||
      $elem.css('-moz-animation-delay') ||
      $elem.css('-o-animation-delay') ||
      $elem.css('-ms-animation-delay') ||
      '0s';

    var iterationCount = $elem.css('animation-iteration-count') ||
      $elem.css('-webkit-animation-iteration-count') ||
      $elem.css('-moz-animation-iteration-count') ||
      $elem.css('-o-animation-iteration-count') ||
      $elem.css('-ms-animation-iteration-count') ||
      '1';

    var max;
    var len;
    var num;
    var i;

    duration = duration.split(', ');
    delay = delay.split(', ');
    iterationCount = iterationCount.split(', ');

    // The 'duration' size is the same as the 'delay' size
    for (i = 0, len = duration.length, max = Number.NEGATIVE_INFINITY; i < len; i++) {
      num = parseFloat(duration[i]) * parseInt(iterationCount[i], 10) + parseFloat(delay[i]);

      if (num > max) {
        max = num;
      }
    }

    return max;
  }

  /**
   * Returns a scrollbar width
   * @private
   * @returns {Number}
   */
  function getScrollbarWidth() {
    if ($(document).height() <= $(window).height()) {
      return 0;
    }

    var outer = document.createElement('div');
    var inner = document.createElement('div');
    var widthNoScroll;
    var widthWithScroll;

    outer.style.visibility = 'hidden';
    outer.style.width = '100px';
    document.body.appendChild(outer);

    widthNoScroll = outer.offsetWidth;

    // Force scrollbars
    outer.style.overflow = 'scroll';

    // Add inner div
    inner.style.width = '100%';
    outer.appendChild(inner);

    widthWithScroll = inner.offsetWidth;

    // Remove divs
    outer.parentNode.removeChild(outer);

    return widthNoScroll - widthWithScroll;
  }

  /**
   * Locks the screen
   * @private
   */
  function lockScreen() {
    if (IS_IOS) {
      return;
    }

    var $html = $('html');
    var lockedClass = namespacify('is-locked');
    var paddingRight;
    var $body;

    if (!$html.hasClass(lockedClass)) {
      $body = $(document.body);

      // Zepto does not support '-=', '+=' in the `css` method
      paddingRight = parseInt($body.css('padding-right'), 10) + getScrollbarWidth();

      $body.css('padding-right', paddingRight + 'px');
      $html.addClass(lockedClass);
    }
  }

  /**
   * Unlocks the screen
   * @private
   */
  function unlockScreen() {
    if (IS_IOS) {
      return;
    }

    var $html = $('html');
    var lockedClass = namespacify('is-locked');
    var paddingRight;
    var $body;

    if ($html.hasClass(lockedClass)) {
      $body = $(document.body);

      // Zepto does not support '-=', '+=' in the `css` method
      paddingRight = parseInt($body.css('padding-right'), 10) - getScrollbarWidth();

      $body.css('padding-right', paddingRight + 'px');
      $html.removeClass(lockedClass);
    }
  }

  /**
   * Sets a state for an instance
   * @private
   * @param {Remodal} instance
   * @param {STATES} state
   * @param {Boolean} isSilent If true, Remodal does not trigger events
   * @param {String} Reason of a state change.
   */
  function setState(instance, state, isSilent, reason) {

    var newState = namespacify('is', state);
    var allStates = [namespacify('is', STATES.CLOSING),
                     namespacify('is', STATES.OPENING),
                     namespacify('is', STATES.CLOSED),
                     namespacify('is', STATES.OPENED)].join(' ');

    instance.$bg
      .removeClass(allStates)
      .addClass(newState);

    instance.$overlay
      .removeClass(allStates)
      .addClass(newState);

    instance.$wrapper
      .removeClass(allStates)
      .addClass(newState);

    instance.$modal
      .removeClass(allStates)
      .addClass(newState);

    instance.state = state;
    !isSilent && instance.$modal.trigger({
      type: state,
      reason: reason
    }, [{ reason: reason }]);
  }

  /**
   * Synchronizes with the animation
   * @param {Function} doBeforeAnimation
   * @param {Function} doAfterAnimation
   * @param {Remodal} instance
   */
  function syncWithAnimation(doBeforeAnimation, doAfterAnimation, instance) {
    var runningAnimationsCount = 0;

    var handleAnimationStart = function(e) {
      if (e.target !== this) {
        return;
      }

      runningAnimationsCount++;
    };

    var handleAnimationEnd = function(e) {
      if (e.target !== this) {
        return;
      }

      if (--runningAnimationsCount === 0) {

        // Remove event listeners
        $.each(['$bg', '$overlay', '$wrapper', '$modal'], function(index, elemName) {
          instance[elemName].off(ANIMATIONSTART_EVENTS + ' ' + ANIMATIONEND_EVENTS);
        });

        doAfterAnimation();
      }
    };

    $.each(['$bg', '$overlay', '$wrapper', '$modal'], function(index, elemName) {
      instance[elemName]
        .on(ANIMATIONSTART_EVENTS, handleAnimationStart)
        .on(ANIMATIONEND_EVENTS, handleAnimationEnd);
    });

    doBeforeAnimation();

    // If the animation is not supported by a browser or its duration is 0
    if (
      getAnimationDuration(instance.$bg) === 0 &&
      getAnimationDuration(instance.$overlay) === 0 &&
      getAnimationDuration(instance.$wrapper) === 0 &&
      getAnimationDuration(instance.$modal) === 0
    ) {

      // Remove event listeners
      $.each(['$bg', '$overlay', '$wrapper', '$modal'], function(index, elemName) {
        instance[elemName].off(ANIMATIONSTART_EVENTS + ' ' + ANIMATIONEND_EVENTS);
      });

      doAfterAnimation();
    }
  }

  /**
   * Closes immediately
   * @private
   * @param {Remodal} instance
   */
  function halt(instance) {
    if (instance.state === STATES.CLOSED) {
      return;
    }

    $.each(['$bg', '$overlay', '$wrapper', '$modal'], function(index, elemName) {
      instance[elemName].off(ANIMATIONSTART_EVENTS + ' ' + ANIMATIONEND_EVENTS);
    });

    instance.$bg.removeClass(instance.settings.modifier);
    instance.$overlay.removeClass(instance.settings.modifier).hide();
    instance.$wrapper.hide();
    unlockScreen();
    setState(instance, STATES.CLOSED, true);
  }

  /**
   * Parses a string with options
   * @private
   * @param str
   * @returns {Object}
   */
  function parseOptions(str) {
    var obj = {};
    var arr;
    var len;
    var val;
    var i;

    // Remove spaces before and after delimiters
    str = str.replace(/\s*:\s*/g, ':').replace(/\s*,\s*/g, ',');

    // Parse a string
    arr = str.split(',');
    for (i = 0, len = arr.length; i < len; i++) {
      arr[i] = arr[i].split(':');
      val = arr[i][1];

      // Convert a string value if it is like a boolean
      if (typeof val === 'string' || val instanceof String) {
        val = val === 'true' || (val === 'false' ? false : val);
      }

      // Convert a string value if it is like a number
      if (typeof val === 'string' || val instanceof String) {
        val = !isNaN(val) ? +val : val;
      }

      obj[arr[i][0]] = val;
    }

    return obj;
  }

  /**
   * Generates a string separated by dashes and prefixed with NAMESPACE
   * @private
   * @param {...String}
   * @returns {String}
   */
  function namespacify() {
    var result = NAMESPACE;

    for (var i = 0; i < arguments.length; ++i) {
      result += '-' + arguments[i];
    }

    return result;
  }

  /**
   * Handles the hashchange event
   * @private
   * @listens hashchange
   */
  function handleHashChangeEvent() {
    var id = location.hash.replace('#', '');
    var instance;
    var $elem;

    if (!id) {

      // Check if we have currently opened modal and animation was completed
      if (current && current.state === STATES.OPENED && current.settings.hashTracking) {
        current.close();
      }
    } else {

      // Catch syntax error if your hash is bad
      try {
        $elem = $(
          '[data-' + PLUGIN_NAME + '-id="' + id + '"]'
        );
      } catch (err) {}

      if ($elem && $elem.length) {
        instance = $[PLUGIN_NAME].lookup[$elem.data(PLUGIN_NAME)];

        if (instance && instance.settings.hashTracking) {
          instance.open();
        }
      }

    }
  }

  /**
   * Remodal constructor
   * @constructor
   * @param {jQuery} $modal
   * @param {Object} options
   */
  function Remodal($modal, options) {
    var $body = $(document.body);
    var $appendTo = $body;
    var remodal = this;

    remodal.settings = $.extend({}, DEFAULTS, options);
    remodal.index = $[PLUGIN_NAME].lookup.push(remodal) - 1;
    remodal.state = STATES.CLOSED;

    remodal.$overlay = $('.' + namespacify('overlay'));

    if (remodal.settings.appendTo !== null && remodal.settings.appendTo.length) {
      $appendTo = $(remodal.settings.appendTo);
    }

    if (!remodal.$overlay.length) {
      remodal.$overlay = $('<div>').addClass(namespacify('overlay') + ' ' + namespacify('is', STATES.CLOSED)).hide();
      $appendTo.append(remodal.$overlay);
    }

    remodal.$bg = $('.' + namespacify('bg')).addClass(namespacify('is', STATES.CLOSED));

    remodal.$modal = $modal
      .addClass(
        NAMESPACE + ' ' +
        namespacify('is-initialized') + ' ' +
        remodal.settings.modifier + ' ' +
        namespacify('is', STATES.CLOSED))
      .attr('tabindex', '-1');

    remodal.$wrapper = $('<div>')
      .addClass(
        namespacify('wrapper') + ' ' +
        remodal.settings.modifier + ' ' +
        namespacify('is', STATES.CLOSED))
      .hide()
      .append(remodal.$modal);
    $appendTo.append(remodal.$wrapper);

    // Add the event listener for the close button
    remodal.$wrapper.on('click.' + NAMESPACE, '[data-' + PLUGIN_NAME + '-action="close"]', function(e) {
      e.preventDefault();

      remodal.close();
    });

    // Add the event listener for the cancel button
    remodal.$wrapper.on('click.' + NAMESPACE, '[data-' + PLUGIN_NAME + '-action="cancel"]', function(e) {
      e.preventDefault();

      remodal.$modal.trigger(STATE_CHANGE_REASONS.CANCELLATION);

      if (remodal.settings.closeOnCancel) {
        remodal.close(STATE_CHANGE_REASONS.CANCELLATION);
      }
    });

    // Add the event listener for the confirm button
    remodal.$wrapper.on('click.' + NAMESPACE, '[data-' + PLUGIN_NAME + '-action="confirm"]', function(e) {
      e.preventDefault();

      remodal.$modal.trigger(STATE_CHANGE_REASONS.CONFIRMATION);

      if (remodal.settings.closeOnConfirm) {
        remodal.close(STATE_CHANGE_REASONS.CONFIRMATION);
      }
    });

    // Add the event listener for the overlay
    remodal.$wrapper.on('click.' + NAMESPACE, function(e) {
      var $target = $(e.target);

      if (!$target.hasClass(namespacify('wrapper'))) {
        return;
      }

      if (remodal.settings.closeOnOutsideClick) {
        remodal.close();
      }
    });
  }

  /**
   * Opens a modal window
   * @public
   */
  Remodal.prototype.open = function() {
    var remodal = this;
    var id;

    // Check if the animation was completed
    if (remodal.state === STATES.OPENING || remodal.state === STATES.CLOSING) {
      return;
    }

    id = remodal.$modal.attr('data-' + PLUGIN_NAME + '-id');

    if (id && remodal.settings.hashTracking) {
      scrollTop = $(window).scrollTop();
      location.hash = id;
    }

    if (current && current !== remodal) {
      halt(current);
    }
      
      
      
      
      // for each button

      if (id == "edit-profile-picture") {
          
          document.getElementById('input-profile-picture').value = "";
          document.getElementById('preview-profile-picture').style.backgroundImage = 'url("../img/choose_image.png")';
          
          document.getElementById('select-profile-picture').style.borderColor = "#039da6";
          document.getElementById('error-profile-picture').style.visibility = "hidden";
          
          
          
      } else if ( id == 'add-admin' ) {
          
          document.getElementById('admin-existing-email').value = "";
          document.getElementById('admin-new-email').value = "";
          document.getElementById('admin-first-name').value = "";
          document.getElementById('admin-last-name').value = "";
          document.getElementById('admin-phone').value = "";
          
          document.getElementById('error-existing-email').innerHTML = "";
          document.getElementById('error-existing-email').style.visibility = "hidden";
          
          document.getElementById('error-new-email').innerHTML = "";
          document.getElementById('error-new-email').style.visibility = "hidden";
          
          document.getElementById('admin-first-name').style.borderColor = "#d1d1d1";
          document.getElementById('admin-last-name').style.borderColor = "#d1d1d1";
          document.getElementById('admin-new-email').style.borderColor = "#d1d1d1";
          document.getElementById('admin-existing-email').style.borderColor = "#d1d1d1";
          document.getElementById('admin-phone').style.borderColor = "#d1d1d1";
          
          admin_data = {
            first_name: "",
            last_name: "",
            phone: "",
            new_email: "",
            existing_email: ""
          }
          
      } else if ( id == 'add-campaign' ) {
          
          document.getElementById('new-url').value = "";
          document.getElementById('new-start-date').value = "";
          document.getElementById('new-end-date').value = "";
          document.getElementById('new-language').value = "";
          document.getElementById('new-book').value = "";
          document.getElementById('new-total-goal').value = "";
          document.getElementById('new-verse-price').value = "";
          
          document.getElementById('error-url').innerHTML = "";
          document.getElementById('error-url').style.visibility = "hidden";
          
          document.getElementById('new-url').style.borderColor = "#d1d1d1";
          document.getElementById('new-start-date').style.borderColor = "#d1d1d1";
          document.getElementById('new-end-date').style.borderColor = "#d1d1d1";
          document.getElementById('new-language').style.borderColor = "#d1d1d1";
          document.getElementById('new-book').style.borderColor = "#d1d1d1";
          document.getElementById('new-total-goal').style.borderColor = "#d1d1d1";
          document.getElementById('new-verse-price').style.borderColor = "#d1d1d1";
          
          $( "#new-goal-description.ql-container" ).css( "border-color", "#d1d1d1" );
          var edits = document.getElementById('new-goal-description').getElementsByClassName("ql-editor");
          for(var i = 0; i < edits.length; i++) {
                edits[i].innerHTML = "<p><br></p>";
          }
      
          campaign_description = "";
          campaign_data = {
            url: "",
            start_date: "",
            end_date: "",
            language: "",
            book: "",
            total_goal: "",
            verse_price: ""
          }
          
      } else if ( id == 'campaign-details' ) {
      
          console.log(campaign_id);
          if (campaign_id == '') {
              window.location.href = "church.php?id="+church_id;
          } else {
              
              clearInterval(timeinterval);
              $('.d-day').css({ display: "none" });
              
              document.getElementById('campaign-goal-description').innerHTML = '<div id="details-goal-description" class="text-editor"></div>';
              document.getElementById('campaign-duration').innerHTML = '<input type="date" class="admin-text" id="details-start-date" onchange="edit_start_date(this)">&nbsp; to &nbsp;<input type="date" class="admin-text" id="details-end-date" onchange="edit_end_date(this)">';
              
              details_goal_description = new Quill('#details-goal-description', { theme: 'snow' });
              
              var goal = parseFloat(campaigns[campaign_id]['goal_amount'].toString().replace(/,/g,''));

              var verse = parseFloat(campaigns[campaign_id]['verse_price'].toString().replace(/,/g,''));

              // figure out dates
              var start_now = new Date(campaigns[campaign_id]['start_date']);
              var start_day = ("0" + start_now.getDate()).slice(-2);
              var start_month = ("0" + (start_now.getMonth() + 1)).slice(-2);

              var end_now = new Date(campaigns[campaign_id]['end_date']);
              var end_day = ("0" + end_now.getDate()).slice(-2);
              var end_month = ("0" + (end_now.getMonth() + 1)).slice(-2);

              var start_date = start_now.getFullYear()+"-"+(start_month)+"-"+(start_day);
              var end_date = end_now.getFullYear()+"-"+(end_month)+"-"+(end_day);
              
              document.getElementById('details-url').innerHTML = "adopt-wycliffe.org/"+campaigns[campaign_id]['url'];
              document.getElementById('details-language').innerHTML = campaigns[campaign_id]['language'];
              document.getElementById('details-book').innerHTML = campaigns[campaign_id]['book'];
              document.getElementById('details-goal-amount').innerHTML = goal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              document.getElementById('details-verse-price').innerHTML = verse.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              
              details_description = campaigns[campaign_id]['goal_description'];
              details_data = {
                start_date: start_date,
                end_date: end_date
              }
              
              if (campaigns[campaign_id]['status'] == "complete") {
                  var start_year = (""+start_now.getFullYear()).slice(-2);
                  var start_month = start_now.getMonth() + 1;
                  var end_year = (""+end_now.getFullYear()).slice(-2);
                  var end_month = end_now.getMonth() + 1;
                  var start = start_month+"/"+start_now.getDate()+"/"+start_year;
                  var end = end_month+"/"+end_now.getDate()+"/"+end_year;
                  document.getElementById('details-buttons').innerHTML = '';
                  document.getElementById('campaign-duration').innerHTML = "<p>"+start+"&nbsp; to &nbsp;"+end+"</p>";
                  document.getElementById('campaign-goal-description').innerHTML = campaigns[campaign_id]['goal_description'];
              } else {
                  
                  $('.d-day').css({ display: "inline-block" });
                  
                  
                  var edits = document.getElementById('details-goal-description').getElementsByClassName("ql-editor");
                  for(var i = 0; i < edits.length; i++) {
                      edits[i].innerHTML = campaigns[campaign_id]['goal_description'];
                  }
                  
                  if (campaigns[campaign_id]['status'] == "inprogress") {
                      var start_year = (""+start_now.getFullYear()).slice(-2);
                      var start_month = start_now.getMonth() + 1;
                      var start = start_month+"/"+start_now.getDate()+"/"+start_year;
                      document.getElementById('campaign-duration').innerHTML = start+'&nbsp; to &nbsp;<input type="date" class="admin-text" id="details-end-date" onchange="edit_end_date(this)">';
                      
                      countdownDate(campaigns[campaign_id]['end_date']);
                  } else {
                      document.getElementById('details-start-date').value = start_date;
                      
                      countdownDate(campaigns[campaign_id]['start_date']);
                  }
                  document.getElementById('details-end-date').value = end_date;
                  
                  var today = new Date();
                  
                  if (start_now > today) {
                      document.getElementById('details-buttons').innerHTML = '<button type="button" class="admin-button-delete" onclick="delete_campaign(\''+campaign_id+'\')">Delete</button><button type="button" class="admin-button" onclick="edit_campaign(\''+campaign_id+'\')">Save Changes</button><a href="../app.php?id='+campaign_id+'" target="_blank"><button type="button" class="admin-submit">Go to Campaign</button></a>';
                  } else {
                      document.getElementById('details-buttons').innerHTML = '<button type="button" class="admin-button" onclick="edit_campaign(\''+campaign_id+'\')">Save Changes</button><a href="../app.php?id='+campaign_id+'" target="_blank"><button type="button" class="admin-submit">Go to Campaign</button></a>';
                  }
              }
          }
          
      
      } else if (id == "add-church") {
          
          document.getElementById('add-church').value = "";
          document.getElementById('input-profile-picture').value = "";
          document.getElementById('preview-profile-picture').style.backgroundImage = "url('../img/choose_image.png')";
          document.getElementById('select-profile-picture').style.borderColor = "#039da6";
          document.getElementById('error-profile-picture').style.visibility = "hidden";
          
      } else if ( id == 'add-language' ) {
          
          document.getElementById('add-language').value = "";
          document.getElementById('add-pdf-url').value = "";
          
          document.getElementById('language-info').style.display = "none";
          document.getElementById('add-language').style.borderColor = "#d1d1d1";
          document.getElementById('add-pdf-url').style.borderColor = "#d1d1d1";
          $( "#add-project-description.ql-container" ).css( "border-color", "#d1d1d1" );
          
          document.getElementById('project-description').innerHTML = '<div id="add-project-description" class="text-editor"></div>';
          
          add_project_description = new Quill('#add-project-description', { theme: 'snow' });
          
          language_add_description = "";
          language_add_data = {
            language: "",
            pdf_url: ""
          }
      } else if (id == "add-wycliffe-admin") {
          
          document.getElementById('admin-email').value = "";
          document.getElementById('admin-first-name').value = "";
          document.getElementById('admin-last-name').value = "";
          document.getElementById('admin-phone').value = "";
          
          document.getElementById('error-email').innerHTML = "";
          document.getElementById('error-email').style.visibility = "hidden";
          
          document.getElementById('admin-first-name').style.borderColor = "#d1d1d1";
          document.getElementById('admin-last-name').style.borderColor = "#d1d1d1";
          document.getElementById('admin-email').style.borderColor = "#d1d1d1";
          document.getElementById('admin-phone').style.borderColor = "#d1d1d1";
          
          admin_data = {
            first_name: "",
            last_name: "",
            phone: "",
            email: ""
          }
          
          
          
      } else if (id == "language-info") {
          
          
          if (language_id == '') {
              window.location.href = "admin.php";
          } else {
          
              document.getElementById('language-people-group').innerHTML = languages[language_id]['people_group'];
              document.getElementById('language-id').innerHTML = language_id;
              document.getElementById('language-region').innerHTML = languages[language_id]['region'];
              document.getElementById('language-number-speakers').innerHTML = languages[language_id]['num_speakers'];
              document.getElementById('language-publish-date').innerHTML = languages[language_id]['publish_date'];
              document.getElementById('language-pdf-url').value = languages[language_id]['pdf_url'];;

              document.getElementById('language-pdf-url').style.borderColor = "#d1d1d1";
              $( "#language-project-description.ql-container" ).css( "border-color", "#d1d1d1" );
              
              document.getElementById('language-description').innerHTML = '<div id="language-project-description" class="text-editor"></div>';
          

              details_project_description = new Quill('#language-project-description', { theme: 'snow' });
              
              var edits = document.getElementById('language-project-description').getElementsByClassName("ql-editor");
              for(var i = 0; i < edits.length; i++) {
                  edits[i].innerHTML = languages[language_id]['project_description'];
              }

              language_details_description = languages[language_id]['project_description'];
              language_details_data = {
                language: language_id,
                pdf_url: languages[language_id]['pdf_url']
              }
              
          }
          
          
      } else if (id == "campaign-info") {
          
          if (campaign_id == '') {
              window.location.href = "admin.php";
          } else {
              
              
              clearInterval(timeinterval);
              $('.d-day').css({ display: "none" });
              
              document.getElementById('campaign-goal-description').innerHTML = '<div id="details-goal-description" class="text-editor"></div>';
              document.getElementById('campaign-duration').innerHTML = '<input type="date" class="admin-text" id="details-start-date" onchange="edit_start_date(this)">&nbsp; to &nbsp;<input type="date" class="admin-text" id="details-end-date" onchange="edit_end_date(this)">';
              
              details_goal_description = new Quill('#details-goal-description', { theme: 'snow' });
              
              var goal = parseFloat(campaigns[campaign_id]['goal_amount'].toString().replace(/,/g,''));

              var verse = parseFloat(campaigns[campaign_id]['verse_price'].toString().replace(/,/g,''));

              // figure out dates
              var start_now = new Date(campaigns[campaign_id]['start_date']);
              var start_day = ("0" + start_now.getDate()).slice(-2);
              var start_month = ("0" + (start_now.getMonth() + 1)).slice(-2);

              var end_now = new Date(campaigns[campaign_id]['end_date']);
              var end_day = ("0" + end_now.getDate()).slice(-2);
              var end_month = ("0" + (end_now.getMonth() + 1)).slice(-2);

              var start_date = start_now.getFullYear()+"-"+(start_month)+"-"+(start_day);
              var end_date = end_now.getFullYear()+"-"+(end_month)+"-"+(end_day);
              
              document.getElementById('details-church').innerHTML = campaigns[campaign_id]['church'];
              document.getElementById('details-url').innerHTML = "adopt-wycliffe.org/"+campaigns[campaign_id]['url'];
              document.getElementById('details-language').innerHTML = campaigns[campaign_id]['language'];
              document.getElementById('details-book').innerHTML = campaigns[campaign_id]['book'];
              document.getElementById('details-goal-amount').innerHTML = "$"+goal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              document.getElementById('details-verse-price').innerHTML = "$"+verse.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              document.getElementById('details-church').innerHTML = campaigns[campaign_id]['church'];
              
              details_description = campaigns[campaign_id]['goal_description'];
              details_data = {
                start_date: start_date,
                end_date: end_date
              }
              
              if (campaigns[campaign_id]['status'] == "complete") {
                  var start_year = (""+start_now.getFullYear()).slice(-2);
                  var start_month = start_now.getMonth() + 1;
                  var end_year = (""+end_now.getFullYear()).slice(-2);
                  var end_month = end_now.getMonth() + 1;
                  var start = start_month+"/"+start_now.getDate()+"/"+start_year;
                  var end = end_month+"/"+end_now.getDate()+"/"+end_year;
                  document.getElementById('details-buttons').innerHTML = '';
                  document.getElementById('campaign-duration').innerHTML = "<p>"+start+"&nbsp; to &nbsp;"+end+"</p>";
                  document.getElementById('campaign-goal-description').innerHTML = campaigns[campaign_id]['goal_description'];
              } else {
                  
                  $('.d-day').css({ display: "inline-block" });
                  
                  
                  var edits = document.getElementById('details-goal-description').getElementsByClassName("ql-editor");
                  for(var i = 0; i < edits.length; i++) {
                      edits[i].innerHTML = campaigns[campaign_id]['goal_description'];
                  }
                  
                  if (campaigns[campaign_id]['status'] == "inprogress") {
                      var start_year = (""+start_now.getFullYear()).slice(-2);
                      var start_month = start_now.getMonth() + 1;
                      var start = start_month+"/"+start_now.getDate()+"/"+start_year;
                      document.getElementById('campaign-duration').innerHTML = start+'&nbsp; to &nbsp;<input type="date" class="admin-text" id="details-end-date" onchange="edit_end_date(this)">';
                      
                      countdownDate(campaigns[campaign_id]['end_date']);
                  } else {
                      document.getElementById('details-start-date').value = start_date;
                      
                      countdownDate(campaigns[campaign_id]['start_date']);
                  }
                  document.getElementById('details-end-date').value = end_date;
                  
                  var today = new Date();
                  
                  if (start_now > today) {
                      document.getElementById('details-buttons').innerHTML = '<button type="button" class="admin-button-delete" onclick="delete_campaign(\''+campaign_id+'\')">Delete</button><button type="button" class="admin-button" onclick="edit_campaign(\''+campaign_id+'\')">Save Changes</button><a href="../app.php?id='+campaign_id+'" target="_blank"><button type="button" class="admin-submit">Go to Campaign</button></a>';
                  } else {
                      document.getElementById('details-buttons').innerHTML = '<button type="button" class="admin-button" onclick="edit_campaign(\''+campaign_id+'\')">Save Changes</button><a href="../app.php?id='+campaign_id+'" target="_blank"><button type="button" class="admin-submit">Go to Campaign</button></a>';
                  }
              }
              
          }
          
      } else if (id == "user-info") {
          
          if (user_id == '') {
              window.location.href = "admin.php";
          } else {
              
              
              document.getElementById('user-first-name').style.borderColor = "#d1d1d1";
              document.getElementById('user-last-name').style.borderColor = "#d1d1d1";
              document.getElementById('user-phone').style.borderColor = "#d1d1d1";
              document.getElementById('user-email').style.borderColor = "#d1d1d1";
              
              document.getElementById('error-email').style.visibility = "hidden";
              
              
              switch(users[user_id]['role']) {
                  case "user":
                      document.getElementById('user-role').innerHTML = "User";
                      break;
                  case "campaign_admin":
                      document.getElementById('user-role').innerHTML = "Church Administrator";
                      break;
                  case "wycliffe_admin":
                      document.getElementById('user-role').innerHTML = "Wycliffe Administrator";
                      break;
                  default:
                      break;
              }
              
              var r_date = new Date(users[user_id]['register_date']);
              var r_year = (""+r_date.getFullYear()).slice(-2);
              var r_month = r_date.getMonth() + 1;
              var register_date = r_month+"/"+r_date.getDate()+"/"+r_year;
              
              document.getElementById('register-date').innerHTML = register_date;
              
              document.getElementById('user-first-name').value = users[user_id]['first_name'];
              document.getElementById('user-last-name').value = users[user_id]['last_name'];
              document.getElementById('user-phone').value = users[user_id]['phone'];
              document.getElementById('user-email').value = users[user_id]['email'];
    
              
              user_data['first_name'] = users[user_id]['first_name'];
              user_data['last_name'] = users[user_id]['last_name'];
              user_data['phone'] = users[user_id]['phone'];
              user_data['email'] = users[user_id]['email'];
              user_data['initial_email'] = users[user_id]['email'];
          }
          
      }
      

      
      
    current = remodal;
    lockScreen();
    remodal.$bg.addClass(remodal.settings.modifier);
    remodal.$overlay.addClass(remodal.settings.modifier).show();
    remodal.$wrapper.show().scrollTop(0);
    remodal.$modal.focus();

    syncWithAnimation(
      function() {
        setState(remodal, STATES.OPENING);
      },

      function() {
        setState(remodal, STATES.OPENED);
      },

      remodal);
  };

  /**
   * Closes a modal window
   * @public
   * @param {String} reason
   */
  Remodal.prototype.close = function(reason) {
    var remodal = this;

    // Check if the animation was completed
    if (remodal.state === STATES.OPENING || remodal.state === STATES.CLOSING || remodal.state === STATES.CLOSED) {
      return;
    }

    if (
      remodal.settings.hashTracking &&
      remodal.$modal.attr('data-' + PLUGIN_NAME + '-id') === location.hash.substr(1)
    ) {
      location.hash = '';
      $(window).scrollTop(scrollTop);
    }

    syncWithAnimation(
      function() {
        setState(remodal, STATES.CLOSING, false, reason);
      },

      function() {
        remodal.$bg.removeClass(remodal.settings.modifier);
        remodal.$overlay.removeClass(remodal.settings.modifier).hide();
        remodal.$wrapper.hide();
        unlockScreen();

        setState(remodal, STATES.CLOSED, false, reason);
      },

      remodal);
  };

  /**
   * Returns a current state of a modal
   * @public
   * @returns {STATES}
   */
  Remodal.prototype.getState = function() {
    return this.state;
  };

  /**
   * Destroys a modal
   * @public
   */
  Remodal.prototype.destroy = function() {
    var lookup = $[PLUGIN_NAME].lookup;
    var instanceCount;

    halt(this);
    this.$wrapper.remove();

    delete lookup[this.index];
    instanceCount = $.grep(lookup, function(instance) {
      return !!instance;
    }).length;

    if (instanceCount === 0) {
      this.$overlay.remove();
      this.$bg.removeClass(
        namespacify('is', STATES.CLOSING) + ' ' +
        namespacify('is', STATES.OPENING) + ' ' +
        namespacify('is', STATES.CLOSED) + ' ' +
        namespacify('is', STATES.OPENED));
    }
  };

  /**
   * Special plugin object for instances
   * @public
   * @type {Object}
   */
  $[PLUGIN_NAME] = {
    lookup: []
  };

  /**
   * Plugin constructor
   * @constructor
   * @param {Object} options
   * @returns {JQuery}
   */
  $.fn[PLUGIN_NAME] = function(opts) {
    var instance;
    var $elem;

    this.each(function(index, elem) {
      $elem = $(elem);

      if ($elem.data(PLUGIN_NAME) == null) {
        instance = new Remodal($elem, opts);
        $elem.data(PLUGIN_NAME, instance.index);

        if (
          instance.settings.hashTracking &&
          $elem.attr('data-' + PLUGIN_NAME + '-id') === location.hash.substr(1)
        ) {
          instance.open();
        }
      } else {
        instance = $[PLUGIN_NAME].lookup[$elem.data(PLUGIN_NAME)];
      }
    });

    return instance;
  };

  $(document).ready(function() {

    // data-remodal-target opens a modal window with the special Id
    $(document).on('click', '[data-' + PLUGIN_NAME + '-target]', function(e) {
      e.preventDefault();

      var elem = e.currentTarget;
      var id = elem.getAttribute('data-' + PLUGIN_NAME + '-target');
      var $target = $('[data-' + PLUGIN_NAME + '-id="' + id + '"]');

      $[PLUGIN_NAME].lookup[$target.data(PLUGIN_NAME)].open();
    });

    // Auto initialization of modal windows
    // They should have the 'remodal' class attribute
    // Also you can write the `data-remodal-options` attribute to pass params into the modal
    $(document).find('.' + NAMESPACE).each(function(i, container) {
      var $container = $(container);
      var options = $container.data(PLUGIN_NAME + '-options');

      if (!options) {
        options = {};
      } else if (typeof options === 'string' || options instanceof String) {
        options = parseOptions(options);
      }

      $container[PLUGIN_NAME](options);
    });

    // Handles the keydown event
    $(document).on('keydown.' + NAMESPACE, function(e) {
      if (current && current.settings.closeOnEscape && current.state === STATES.OPENED && e.keyCode === 27) {
        current.close();
      }
    });

    // Handles the hashchange event
    $(window).on('hashchange.' + NAMESPACE, handleHashChangeEvent);
  });
});
