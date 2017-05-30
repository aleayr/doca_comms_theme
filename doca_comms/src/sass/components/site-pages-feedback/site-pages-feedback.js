// Generated by CoffeeScript 1.10.0
(function() {
  var $, Drupal, document;

  $ = this.jQuery;

  document = this.document;

  Drupal = this.Drupal;

  this.Drupal.behaviors.siteFeedback = {
    attach: function(context, settings) {

      /*
      Site pages feedback.
       */
      var options, ref, ref1, sendData, sendPopup, sendResponse, setData;
      if ((settings.sitePagesFeedback != null) && (settings.sitePagesFeedback['nid'] != null)) {

        /*
        Options object.
         */
        options = {
          nid: (ref = settings.sitePagesFeedback['nid']) != null ? ref : null,
          sid: null,
          token: null,
          url: (ref1 = settings.currentPath) != null ? ref1 : window.location.href,
          option: 0,
          update: false
        };

        /*
        Set data.
         */
        setData = function(key, value) {
          options[key] = value;
        };

        /*
        Response callback.
         */
        sendResponse = function() {
          $(".site-feedback-block__inner .main", context).fadeOut("slow", function() {
            $(".site-feedback-block__inner .message", context).fadeIn();
          });
        };

        /*
        Open Popup window.
         */
        sendPopup = function() {
          $.magnificPopup.open({
            items: {
              preloader: true,
              src: '#site-feedback-form',
              type: 'inline'
            }
          });
        };

        /*
        Ajax handler.
         */
        sendData = function() {
          var url;
          sendResponse();
          if ((options != null) && (options.nid != null)) {
            url = location.protocol + "//" + location.host + settings.basePath + settings.pathToTheme + '/api/ajax/feedback/submit_simple.php';
            $.ajax(url, {
              type: 'POST',
              data: options,
              success: function(data) {
                if ((data != null) && (data.sid != null) && options.option === 0) {
                  setData('sid', data.sid);
                  $("input[name~='submitted[site_feedback_page_url]']").val(options.url);
                  $("input[name~='submitted[site_feedback_helpful]']").val(0).prop("checked", true);
                  $("input[name~='details[sid]']").val(data.sid);
                  $("input[name~='site_feedback_sid']").val(data.sid);
                  sendPopup();
                }
              },
              error: function(jqXHR) {}
            });
          }
        };

        /*
        Onclick event.
         */
        $(".site-feedback-action", context).click(function(e) {
          var option, ref2;
          e.preventDefault();
          option = (ref2 = $(this).data('spf-option')) != null ? ref2 : 0;
          setData('option', option);
          sendData();
        });
      }
    }
  };

}).call(this);

//# sourceMappingURL=site-pages-feedback.js.map