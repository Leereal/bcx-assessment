(function ($) {
    "use strict";
    $(document).on("click", ".btn-remove", function () {
      //Sweet Alert for delete action
      Swal.fire({
        title: $lang_alert_title,
        text: $lang_alert_message,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: $lang_confirm_button_text,
        cancelButtonText: $lang_cancel_button_text,
      }).then((result) => {
        if (result.value) {
          $(this).closest("form").submit();
        }
      });

      return false;
    });

    if (
      $("input:required, select:required, textarea:required")
        .closest(".form-group")
        .find(".required").length == 0
    ) {
      $("input:required, select:required, textarea:required")
        .closest(".form-group")
        .find("label")
        .append("<span class='required'> *</span>");
    }



    //Ajax Modal Submit
    $(document).on("submit", ".ajax-submit", function () {
      var link = $(this).attr("action");
      var reload = $(this).data("reload");
      var current_modal = $(this).closest(".modal");

      var elem = $(this);
      $(elem).find("button[type=submit]").prop("disabled", true);

      $.ajax({
        method: "POST",
        url: link,
        data: new FormData(this),
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          $("#preloader").css("display", "block");
        },
        success: function (data) {
          $(elem).find("button[type=submit]").attr("disabled", false);
          $("#preloader").css("display", "none");
          var json = JSON.parse(data);
          if (json["result"] == "success") {
            if (reload != false) {
              //Main Modal
              if (json["action"] == "store") {
                $("#main_modal .ajax-submit")[0].reset();
              }
              $("#main_modal .alert-primary").html(json["message"]);
              $("#main_modal .alert-primary").removeClass("d-none");
              $("#main_modal .alert-danger").addClass("d-none");

              window.setTimeout(function () {
                window.location.reload();
              }, 500);
            } else {
              //Secondary Modal
              if (json["action"] == "store") {
                $(current_modal).find(".ajax-submit")[0].reset();
              }

              $(current_modal).find(".alert-primary").html(json["message"]);
              $(current_modal).find(".alert-primary").removeClass("d-none");
              $(current_modal).find(".alert-danger").addClass("d-none");

              var select_value = json["data"][target_select.data("value")];
              var select_display = json["data"][target_select.data("display")];

              var newOption = new Option(
                select_display,
                select_value,
                true,
                true
              );
              target_select.append(newOption).trigger("change");
              $(current_modal).modal("hide");
            }
          } else {
            if (Array.isArray(json["message"])) {
              if (reload != false) {
                //Main Modal
                jQuery.each(json["message"], function (i, val) {
                  $("#main_modal .alert-danger").append("<p>" + val + "</p>");
                });
                $("#main_modal .alert-primary").addClass("d-none");
                $("#main_modal .alert-danger").removeClass("d-none");
              } else {
                //Secondary Modal
                jQuery.each(json["message"], function (i, val) {
                  $(current_modal)
                    .find(".alert-danger")
                    .append("<p>" + val + "</p>");
                });
                $(current_modal).find(".alert-primary").addClass("d-none");
                $(current_modal).find(".alert-danger").removeClass("d-none");
              }
            } else {
              if (reload != false) {
                $("#main_modal .alert-danger").html(
                  "<p>" + json["message"] + "</p>"
                );
                $("#main_modal .alert-primary").addClass("d-none");
                $("#main_modal .alert-danger").removeClass("d-none");
              } else {
                $(current_modal)
                  .find(".alert-danger")
                  .html("<p>" + json["message"] + "</p>");
                $(current_modal).find(".alert-primary").addClass("d-none");
                $(current_modal).find(".alert-danger").removeClass("d-none");
              }
            }
          }
        },
        error: function (request, status, error) {
          console.log(request.responseText);
        },
      });

      return false;
    });

    //Ajax Modal Submit without loading
    $(document).on("submit", ".ajax-screen-submit", function () {
      var link = $(this).attr("action");
      var reload = $(this).data("reload");
      var current_modal = $(this).closest(".modal");

      var elem = $(this);
      $(elem).find("button[type=submit]").prop("disabled", true);

      $.ajax({
        method: "POST",
        url: link,
        data: new FormData(this),
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          $("#preloader").css("display", "block");
        },
        success: function (data) {
          $(elem).find("button[type=submit]").attr("disabled", false);
          $("#preloader").css("display", "none");
          var json = JSON.parse(data);
          if (json["result"] == "success") {
            $(document).trigger("ajax-screen-submit");

            $.toast({
              text: json["message"],
              showHideTransition: "slide",
              icon: "success",
              position: "top-right",
            });

            var table = json["table"];

            if (json["action"] == "update") {
              $(table + ' tr[data-id="row_' + json["data"]["id"] + '"]')
                .find("td")
                .each(function () {
                  if (typeof $(this).attr("class") != "undefined") {
                    $(this).html(
                      json["data"][$(this).attr("class").split(" ")[0]]
                    );
                  }
                });
            } else if (json["action"] == "store") {
              $(elem)[0].reset();
              var new_row = $(table).find("tbody").find("tr:eq(0)").clone();

              $(new_row).attr("data-id", "row_" + json["data"]["id"]);

              $(new_row)
                .find("td")
                .each(function () {
                  if ($(this).attr("class") == "dataTables_empty") {
                    window.location.reload();
                  }
                  if (typeof $(this).attr("class") != "undefined") {
                    $(this).html(
                      json["data"][$(this).attr("class").split(" ")[0]]
                    );
                  }
                });

              $(new_row)
                .find("form")
                .attr("action", link + "/" + json["data"]["id"]);
              $(new_row)
                .find(".dropdown-edit")
                .attr("data-href", link + "/" + json["data"]["id"] + "/edit");
              $(new_row)
                .find(".dropdown-view")
                .attr("data-href", link + "/" + json["data"]["id"]);

              $(table).prepend(new_row);

              if (reload == false) {
                var select_value = json["data"][target_select.data("value")];
                var select_display = json["data"][target_select.data("display")];

                var newOption = new Option(
                  select_display,
                  select_value,
                  true,
                  true
                );
                target_select.append(newOption).trigger("change");
                $(current_modal).modal("hide");
              }
            }

            $(current_modal).find(".alert-primary").addClass("d-none");
            $(current_modal).find(".alert-danger").addClass("d-none");
          } else if (json["result"] == "error") {
            $(current_modal).find(".alert-danger").html("");
            if (Array.isArray(json["message"])) {
              jQuery.each(json["message"], function (i, val) {
                $(current_modal)
                  .find(".alert-danger")
                  .append("<p>" + val + "</p>");
              });
              $(current_modal).find(".alert-primary").addClass("d-none");
              $(current_modal).find(".alert-danger").removeClass("d-none");
            } else {
              $(current_modal)
                .find(".alert-danger")
                .html("<p>" + json["message"] + "</p>");
              $(current_modal).find(".alert-primary").addClass("d-none");
              $(current_modal).find(".alert-danger").removeClass("d-none");
            }
          } else {
            $.toast({
              text: data.replace(/(<([^>]+)>)/gi, ""),
              showHideTransition: "slide",
              icon: "error",
              position: "top-right",
            });
          }
        },
        error: function (request, status, error) {
          console.log(request.responseText);
        },
      });

      return false;
    });

    //Ajax Remove without loading
    $(document).on("click", ".ajax-get-remove", function () {
      var current_modal = $(this).closest(".modal");

      Swal.fire({
        title: $lang_alert_title,
        text: $lang_alert_message,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: $lang_confirm_button_text,
        cancelButtonText: $lang_cancel_button_text,
      }).then((result) => {
        if (result.value) {
          var link = $(this).attr("href");
          $.ajax({
            method: "GET",
            url: link,
            beforeSend: function () {
              $("#preloader").css("display", "block");
            },
            success: function (data) {
              $("#preloader").css("display", "none");

              var json = JSON.parse(JSON.stringify(data));
              console.log(json["result"]);
              if (json["result"] == "success") {
                $.toast({
                  text: json["message"],
                  showHideTransition: "slide",
                  icon: "success",
                  position: "top-right",
                });

                var table = json["table"];
                //$(table).find('#row_' + json['id']).remove();
                $(table + ' tr[data-id="row_' + json["id"] + '"]').remove();
              } else if (json["result"] == "error") {
                if (Array.isArray(json["message"])) {
                  jQuery.each(json["message"], function (i, val) {
                    $.toast({
                      text: val,
                      showHideTransition: "slide",
                      icon: "error",
                      position: "top-right",
                    });
                  });
                } else {
                  $.toast({
                    text: json["message"],
                    showHideTransition: "slide",
                    icon: "error",
                    position: "top-right",
                  });
                }
              } else {
                $.toast({
                  text: data.replace(/(<([^>]+)>)/gi, ""),
                  showHideTransition: "slide",
                  icon: "error",
                  position: "top-right",
                });
              }
            },
            error: function (request, status, error) {
              console.log(request.responseText);
            },
          });
        }
      });

      return false;
    });

    //Ajax Remove without loading
    $(document).on("submit", ".ajax-remove", function (event) {
      event.preventDefault();

      var current_modal = $(this).closest(".modal");

      Swal.fire({
        title: $lang_alert_title,
        text: $lang_alert_message,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: $lang_confirm_button_text,
        cancelButtonText: $lang_cancel_button_text,
      }).then((result) => {
        if (result.value) {
          var link = $(this).attr("action");
          $.ajax({
            method: "POST",
            url: link,
            data: $(this).serialize(),
            beforeSend: function () {
              $("#preloader").css("display", "block");
            },
            success: function (data) {
              $("#preloader").css("display", "none");
              var json = JSON.parse(JSON.stringify(data));
              if (json["result"] == "success") {
                $.toast({
                  text: json["message"],
                  showHideTransition: "slide",
                  icon: "success",
                  position: "top-right",
                });

                var table = json["table"];
                //$(table).find('#row_' + json['id']).remove();
                $(table + ' tr[data-id="row_' + json["id"] + '"]').remove();
              } else if (json["result"] == "error") {
                if (Array.isArray(json["message"])) {
                  jQuery.each(json["message"], function (i, val) {
                    $.toast({
                      text: val,
                      showHideTransition: "slide",
                      icon: "error",
                      position: "top-right",
                    });
                  });
                } else {
                  $.toast({
                    text: json["message"],
                    showHideTransition: "slide",
                    icon: "error",
                    position: "top-right",
                  });
                }
              } else {
                $.toast({
                  text: data.replace(/(<([^>]+)>)/gi, ""),
                  showHideTransition: "slide",
                  icon: "error",
                  position: "top-right",
                });
              }
            },
            error: function (request, status, error) {
              console.log(request.responseText);
            },
          });
        }
      });
    });

    //Ajax submit without validate
    $(document).on("submit", ".settings-submit", function () {
      var elem = $(this);
      var button_val = "";
      $(elem).find("button[type=submit]").prop("disabled", true);
      var link = $(this).attr("action");
      $.ajax({
        method: "POST",
        url: link,
        data: new FormData(this),
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          $("#preloader").fadeIn();
          button_val = $(elem).find("button[type=submit]").text();
          $(elem)
            .find("button[type=submit]")
            .html(
              '<div class="spinner-border text-primary spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>'
            );
        },
        success: function (data) {
          $("#preloader").fadeOut();
          $(elem).find("button[type=submit]").html(button_val);
          $(elem).find("button[type=submit]").attr("disabled", false);
          var json = JSON.parse(data);

          if (json["result"] == "success") {
            $("#main_alert > span.msg").html(json["message"]);
            $("#main_alert")
              .addClass("alert-success")
              .removeClass("alert-danger");
            $("#main_alert").css("display", "block");
          } else {
            if (Array.isArray(json["message"])) {
              $("#main_alert > span.msg").html("");
              $("#main_alert")
                .addClass("alert-danger")
                .removeClass("alert-success");

              jQuery.each(json["message"], function (i, val) {
                $("#main_alert > span.msg").append(
                  '<i class="far fa-times-circle"></i> ' + val + "<br>"
                );
              });
              $("#main_alert").css("display", "block");
            } else {
              $("#main_alert > span.msg").html("");
              $("#main_alert")
                .addClass("alert-danger")
                .removeClass("alert-success");
              $("#main_alert > span.msg").html("<p>" + json["message"] + "</p>");
              $("#main_alert").css("display", "block");
            }
          }
        },
        error: function (request, status, error) {
          console.log(request.responseText);
        },
      });

      return false;
    });

    //Auto Selected
    if ($(".auto-select").length) {
      $(".auto-select").each(function (i, obj) {
        $(this).val($(this).data("selected")).trigger("change");
      });
    }

    //Access Control
    $(document).on("change", "#permissions #role_id", function () {
        console.log("Liberty");
      showRole($(this));
    });

    $("#permissions .custom-control-input").each(function () {
      if ($(this).prop("checked") == true) {
        $(this).closest(".collapse").addClass("show");
      }
    });
  })(jQuery);

  function showRole(elem) {
    if ($(elem).val() == "") {
      return;
    }
    window.location = _url + "permission/create" + $(elem).val();
  }
