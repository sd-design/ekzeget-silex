jQuery(document).ready(function () {

    jQuery.pdocrud_actions = {
        init: function () {

            jQuery('body').tooltip({selector: '[data-toggle="tooltip"]'});

            jQuery(document).on("change", ".pdocrud-form-control", function (evt) {
                var instance = jQuery.pdocrud_actions.getInstance(this, "form");
                jQuery.pdocrud_actions.loadDependent(this, instance);
            });
            
             jQuery(document).on("change", ".pdocrud-text, .pdocrud-select", function (evt) {
                var instance = jQuery.pdocrud_actions.getInstance(this, "form");
                var data = jQuery(this).data("condition-logic");
                jQuery.pdocrud_actions.applyLogic(this, instance, data);
            });
            
            jQuery(document).on("click", ".pdocrud-adv-search-btn", function (evt) {
                var instance = jQuery.pdocrud_actions.getInstance(this, "form");
                var data = jQuery(this).data();
                data.form_data = jQuery(this).closest("form.pdocrud-adv-search-form").serialize();
                jQuery.pdocrud_actions.getRenderData(this, instance, data);
            });
            
            if (jQuery(".pdocrud-slider").length > 0) {
                 var handle = jQuery("#pdocrud-custom-handle");
                jQuery(".pdocrud-slider").slider({
                    range: jQuery(".pdocrud-slider").data("range"),
                    min: jQuery(".pdocrud-slider").data("min"),
                    max: jQuery(".pdocrud-slider").data("max"),
                    create: function () {
                        handle.text(jQuery(this).slider("value"));
                    },
                    slide: function (event, ui) {
                         handle.text( ui.value );
                        if (jQuery(".pdocrud-slider").data("range"))
                            jQuery(".pdocrud-slider").next().val(ui.values[ 0 ] + "-" + ui.values[ 1 ]);
                        else
                            jQuery(".pdocrud-slider").next().val(ui.value);
                    }
                });
            }

            jQuery(document).on("change", ".pdocrud-filter", function (evt) {
                var instance = jQuery(this).closest(".pdocrud-filters-container").data("objkey");
                var data = jQuery(this).data();
                var key = data.key;
                var val = jQuery(this).val();
                var filters = jQuery(this).closest(".pdocrud-filters-options").find(".pdocrud-filter-selected");
                if (filters.find("span[data-key='" + key + "']").length > 0)
                    filters.find("span[data-key='" + key + "']").data("value", val).text(val+" X");
                else
                    filters.append("<span data-key='" + key + "' data-value='" + val + "' class=\"pdocrud-filter-option\">" + val + " X</span>");                
                data.action = "filter";
                jQuery.pdocrud_actions.actions(this, data, instance, "");
            });
            
            jQuery(document).on("click", ".pdocrud-filter-option", function (evt) {
                 var instance = jQuery(this).closest(".pdocrud-filters-container").data("objkey");
                 var obj = jQuery(".pdocrud-filters-options");
                 var data = jQuery(this).data();
                 jQuery(this).remove();                
                 data.action = "filter";
                 jQuery.pdocrud_actions.actions(obj, data, instance, "");
            });
            
            jQuery(document).on("click", ".pdocrud-filter-option-remove", function (evt) {
                 jQuery(this).siblings(".pdocrud-filter-option").each(function(){
                     jQuery(this).remove();
                 });
                 var data = jQuery(this).data();
                 var instance = jQuery(this).closest(".pdocrud-filters-container").data("objkey");
                 data.action = "filter";
                 jQuery.pdocrud_actions.actions(this, data, instance, "");
            });

            jQuery(document).on("focus", ".pdocrud-date", function (evt) {
                jQuery(this).datepicker({
                    dateFormat: pdocrud_js.date.date_format,
                    changeMonth: pdocrud_js.date.change_month,
                    changeYear: pdocrud_js.date.change_year,
                    numberOfMonths:  pdocrud_js.date.no_of_month,
                    showButtonPanel: pdocrud_js.date.show_button_panel
                });
            });
            
            if (jQuery(".pdocrud_tabs").length > 0) {
                jQuery(".pdocrud_tabs").tabs();
            }
            
            if (jQuery(".pdocrud-form").length > 0) {
                jQuery(".pdocrud-form").stepy({
                    backLabel: 'Previous',
                    block: true,
                    nextLabel: 'Next',
                    titleClick: true,
                    titleTarget: '.stepy-tab'
                });
            }
            
            jQuery(document).on("keyup", "input.pdocruderr, select.pdocruderr, textarea.pdocruderr", function (evt) {
                jQuery(this).next("span.pdocrudform-error").remove();
                jQuery(this).closest(".form-group").removeClass("has-error");
            });

            jQuery(document).on("focus", ".pdocrud-datetime", function (evt) {
                jQuery(this).datetimepicker({dateFormat: pdocrud_js.date.date_format,
                    changeMonth: pdocrud_js.date.change_month,
                    changeYear: pdocrud_js.date.change_year,
                    numberOfMonths:  pdocrud_js.date.no_of_month,
                    showButtonPanel: pdocrud_js.date.show_button_panel});
            });

            jQuery(document).on("focus", ".pdocrud-time", function (evt) {
                jQuery(this).timepicker();
            });

            jQuery(document).on("change", ".pdocrud-select-all", function (evt) {
                jQuery.pdocrud_actions.selectAll(this);
            });


            jQuery(document).on('click', '.pdocrud-submit-btn', function (evt) {
                var data_action = jQuery(this).attr("data-action");
                jQuery(this).siblings(".pdocrud_action_type").val(data_action);
            });

            jQuery(document).on('click', '.pdocrud-cancel-btn', function (evt) {
                var formId = jQuery(this).data("form-id");
                jQuery('#' + formId).resetForm();
            });

            jQuery(document).on('change', '.pdocrud-records-per-page', function (evt) {
                var data = jQuery(this).data();
                data.records = jQuery(this).val();
                var instance = jQuery(this).closest(".pdocrud-table-container").data("objkey");
                jQuery.pdocrud_actions.actions(this, data, instance);
            });
            
            jQuery(document).on('change', '.pdocrud_search_cols', function (evt) {
               var type = jQuery(this).find('option:selected').data('type');
               var search_obj = jQuery(this).closest(".pdocrud-search").children();
               
               search_obj.find("#pdocrud_search_box").datepicker("destroy");
               search_obj.find("#pdocrud_search_box").removeClass("pdocrud-date");
               search_obj.find("#pdocrud_search_box").removeClass("pdocrud-datetime");
               search_obj.find("#pdocrud_search_box").removeClass("pdocrud-time");
               search_obj.find("#pdocrud_search_box_to").datepicker("destroy");
               search_obj.find("#pdocrud_search_box_to").removeClass("pdocrud-date");
               search_obj.find("#pdocrud_search_box_to").removeClass("pdocrud-datetime");
               search_obj.find("#pdocrud_search_box_to").removeClass("pdocrud-time");
               search_obj.find("#pdocrud_search_box_to").addClass("pdocrud-hide");
               
               if(type === "date-range"){
                   search_obj.find("#pdocrud_search_box").addClass("pdocrud-date");
                   search_obj.find("#pdocrud_search_box_to").removeClass("pdocrud-hide");
                   search_obj.find("#pdocrud_search_box_to").addClass("pdocrud-date");
               }
               else if(type === "datetime-range"){
                   search_obj.find("#pdocrud_search_box").addClass("pdocrud-datetime");
                   search_obj.find("#pdocrud_search_box_to").removeClass("pdocrud-hide");
                   search_obj.find("#pdocrud_search_box_to").addClass("pdocrud-datetime");
               }
               else if(type === "time-range"){
                   search_obj.find("#pdocrud_search_box").addClass("pdocrud-time");
                   search_obj.find("#pdocrud_search_box_to").addClass("pdocrud-time");
                   search_obj.find("#pdocrud_search_box_to").removeClass("pdocrud-hide");
               }
            });

            jQuery(document).on('click', '.pdocrud-actions-sorting', function (evt) {
                evt.preventDefault();
                var data = jQuery(this).data();
                var instance = jQuery.pdocrud_actions.getInstance(this, ".pdocrudbox");
                jQuery.pdocrud_actions.actions(this, data, instance);
            });

            jQuery(document).on('click', '.pdocrud-view-print', function (evt) {
                evt.preventDefault();
                var content = "<table>" + jQuery(this).closest("table.pdocrud-table-view").find("tbody")[0].outerHTML + "</table>";
                var printwindow = window.open('', 'print window', 'height=400,width=600');
                jQuery.pdocrud_actions.print(content, printwindow);
            });

            jQuery(document).on('click', 'a.pdocrud-actions', function (evt) {
                evt.preventDefault();
                var printwindow = "";
                var data = jQuery(this).data();
                var instance = jQuery.pdocrud_actions.getInstance(this, ".pdocrudbox");
                if (data.action === "print") {
                    instance = data.objkey;
                    var printdata = jQuery("table[data-obj-key='" + data.objkey + "']")[0].outerHTML;
                    var printwindow = window.open('', 'print window', 'height=400,width=600');
                    jQuery.pdocrud_actions.print(printdata, printwindow);
                }

                if (data.action === "delete") {
                    if (!confirm(pdocrud_js.lang.delete_single_record)) {
                        return;
                    }
                }

                if (data.action === "url") {
                    window.location.href = jQuery(this).attr("href");
                    return;
                }

                if (data.action === "add_row") {
                    $table = jQuery(this).parents(".addrow").siblings("table").children("tbody");
                    $table.append($table.children("tr").prop('outerHTML'));
                    return;
                }

                if (data.action === "delete_row") {
                    if (jQuery(this).parents("tbody").children().length > 1)
                        jQuery(this).parents("tr").remove();
                    return;
                }

                if (data.action === "read_more") {
                    var content = jQuery(this).data("read-more");
                    if (jQuery(this).data("hide") === "true") {
                        jQuery(this).html("read more");
                        jQuery(this).data("hide", "false");
                        jQuery(this).prev("p").html(content.substr(0, 4) + "...");
                    }
                    else {
                        jQuery(this).html("hide");
                        jQuery(this).data("hide", "true");
                        jQuery(this).prev("p").html(content);
                    }
                    return;
                }

                if (data.action === "search") {
                    data.search_col = jQuery(this).closest(".pdocrud-search").children().find(".pdocrud_search_cols").val();
                    data.search_text = jQuery(this).closest(".pdocrud-search").children().find("#pdocrud_search_box").val();
                    var search_to = jQuery(this).closest(".pdocrud-search").children().find("#pdocrud_search_box_to").val();
                    if(search_to)
                        data.search_text2 = search_to;
                }

                if (data.action === "exporttable") {
                    instance = data.objkey;
                    data.exportType = jQuery(this).data("export-type");
                    if (data.exportType === "print")
                        printwindow = window.open('', 'print window', 'height=400,width=600');
                }

                if (data.action === "delete_selected") {
                    if (!confirm(pdocrud_js.lang.delete_select_records)) {
                        return;
                    }
                    var selected = [];
                    var obj_key = jQuery(this).attr("data-obj-key");
                    jQuery("table[data-obj-key='" + obj_key + "']").children().find(".pdocrud-select-cb:checked").each(function () {
                        selected.push(jQuery(this).val());
                    });
                    if (selected.length < 1) {
                        alert(pdocrud_js.lang.select_one_entry);
                        return;
                    }
                    data.selected_ids = selected;
                }

                if (data.action === "pagination") {
                    instance = jQuery(this).closest(".pdocrud-table-container").data("objkey");
                    data.exportType = jQuery(this).data("export-type");
                }
                
                if (data.action === "save_crud_table_data") {
                    instance = jQuery(this).closest(".pdocrud-table-container").data("objkey");
                    var updateData = [];
                    jQuery(".input-bulk-crud-update").each(function () {
                        var col = jQuery(this).data("col");
                        var val = jQuery(this).val();
                        var id = jQuery(this).data("id");
                        updateData.push({col: col, id: id, val:val});

                    });
                   data.updateData = JSON.stringify(updateData);
                }

                if (data.action === "add") {
                    instance = jQuery(this).closest(".pdocrud-table-container").data("objkey");
                }

                jQuery.pdocrud_actions.actions(this, data, instance, printwindow);

            });

            jQuery(document).on('click', '.pdocrud-submit', function (evt) {
                var data_action = jQuery(this).data("action");
                jQuery(this).siblings(".pdocrud_action_type").val(data_action);
            });

            jQuery(document).on('click', '.pdocrud-back', function (evt) {
                var data = jQuery(this).data();
                var instance = jQuery(this).closest(".pdocrud-table-container").data("objkey");
                jQuery.pdocrud_actions.actions(this, data, instance);
                evt.preventDefault();
                if (jQuery('body').hasClass("modal-open"))
                    jQuery('body').removeClass('modal-open');
                jQuery('.modal-backdrop').remove();
                return;
            });
            
            jQuery(document).on('click', '.pdocrud-view-delete', function (evt) {
                if (!confirm(pdocrud_js.lang.delete_single_record)) {
                        return;
                    }
                var data = jQuery(this).data();
                var instance = jQuery(this).closest(".pdocrud-table-container").data("objkey");
                jQuery.pdocrud_actions.actions(this, data, instance);
                evt.preventDefault();
                if (jQuery('body').hasClass("modal-open"))
                    jQuery('body').removeClass('modal-open');
                jQuery('.modal-backdrop').remove();
                return;
            });
            
            jQuery(document).on('click', '.pdocrud-view-edit', function (evt) {
                var data = jQuery(this).data();
                var instance = jQuery(this).closest(".pdocrud-table-container").data("objkey");
                jQuery.pdocrud_actions.actions(this, data, instance);
                evt.preventDefault();
                if (jQuery('body').hasClass("modal-open"))
                    jQuery('body').removeClass('modal-open');
                jQuery('.modal-backdrop').remove();
                return;
            });

            jQuery(document).on('submit', 'form', function (evt) {
                if (pdocrud_js.submission_type === "ajax") {
                    evt.preventDefault();
                    jQuery(this).validator('validate');
                    var validation = true;
                    if (pdocrud_js.jsvalidation === "script_validator") {
                        validation = jQuery.pdocrud_actions.validate(this);
                    }
                    else if (pdocrud_js.jsvalidation === "plugin_validator") {
                        jQuery(this).find(".form-group").each(function () {
                            var class_name = jQuery(this).attr("class");
                            if (class_name.indexOf("has-error") >= 0) {
                                validation = false;
                            }
                        });
                    }

                    if (jQuery(this).find(".g-recaptcha").length) {
                        if (grecaptcha.getResponse() === '') {
                            jQuery(this).find(".g-recaptcha").prepend("<div class='has-errors with-errors'><p>" + pdocrud_js.lang.recaptcha_msg + "</p></div>");
                            validation = false;
                        }
                    }

                    jQuery(document).trigger("pdocrud_before_form_submission", [this]);
                    if (validation) {
                        jQuery.pdocrud_actions.submitData(this);
                    }
                }
            });

            jQuery.pdocrud_actions.createMap(this);
            jQuery(document).trigger("pdocrud_on_load", [this]);
        },
        getRenderData :function (obj, instance, data, form_data) {
            jQuery.ajax({
                type: "post",
                dataType: "html",
                cache: false,
                url: pdocrud_js.pdocrudurl + "script/pdocrud.php",
                beforeSend: function () {
                    jQuery("#pdocrud-ajax-loader").show();
                },
                data: {
                    "pdocrud_data": data,
                    "pdocrud_instance": instance,
                },
                success: function (response) {
                    jQuery("#pdocrud-ajax-loader").hide();
                    jQuery(obj).closest("form").after(response);
                }
            });
        },
        actions: function (obj, data, instance, printwindow) {
            jQuery(document).trigger("pdocrud_before_ajax_action", [obj, data]);
            data = jQuery.pdocrud_actions.getFilterData(obj, data);
            jQuery.ajax({
                type: "post",
                dataType: "html",
                cache: false,
                url: pdocrud_js.pdocrudurl + "script/pdocrud.php",
                beforeSend: function () {
                    jQuery("#pdocrud-ajax-loader").show();
                },
                data: {
                    "pdocrud_data": data,
                    "pdocrud_instance": instance,
                },
                success: function (response) {
                    jQuery("#pdocrud-ajax-loader").hide();
                    if (data.action === "exporttable") {
                        if (data.exportType === "print")
                            jQuery.pdocrud_actions.print(response, printwindow);
                        else
                            window.location.href = response;
                    }
                    else {
                        if (jQuery(obj).closest(".pdocrud-table-container").data("modal")) {
                            var actions_arr = ["view_back", "insert_back", "back", "update_back", "delete", "sort", "asc", "desc", "search", "records_per_page", "pagination"];
                            if (jQuery.inArray(data.action, actions_arr) !== -1) {
                                if (jQuery(obj).parents("body").hasClass("modal-open"))
                                    jQuery(obj).parents("body").removeClass("modal-open");
                                jQuery("#" + instance + "_modal").modal('hide');
                                jQuery(obj).closest(".pdocrud-table-container").html(response);

                            } else {
                                jQuery("#" + instance + "_modal").find(".modal-body").html(response);
                                jQuery("#" + instance + "_modal").modal('show');
                                jQuery("#" + instance + "_modal").on('shown', function () {
                                    jQuery("#" + instance + "_modal").find(".modal-body").find("input").focus();
                                });
                            }
                        }
                        else if (data.action === "inline_edit") {
                            jQuery(obj).closest("tr").html(response);
                        }
                        else if (data.action === "filter") {
                            jQuery(obj).closest(".pdocrud-filters-container").find(".pdocrud-table-container").html(response);
                        }
                        else if (data.action === "onepageedit") {
                            var element = jQuery(obj).closest(".pdocrud-one-page-container");
                            jQuery(obj).closest(".pdocrud-one-page-container").after(response);
                            element.remove();
                            jQuery(obj).closest(".pdocrud-one-page-container").html(response);
                        }
                        else {
                            jQuery(obj).closest(".pdocrud-table-container").html(response);
                        }
                        if (jQuery(".pdocrud_tabs").length > 0) {
                            jQuery(".pdocrud_tabs").tabs();
                        }   
                        jQuery.pdocrud_actions.createMap(obj);
                    }
                    jQuery(document).trigger("pdocrud_after_ajax_action", [obj, response]);
                    try {
                        grecaptcha.render('pdo_recaptcha', {
                            sitekey: pdocrud_js.site_key,
                            callback: function (response) {
                            }
                        });
                    }
                    catch (err) {
                        // Handle error(s) here
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                },
                complete: function () {
                },
            });
        },
         reload: function (obj, data, instance,element) {
            jQuery(document).trigger("pdocrud_before_reload_ajax_action", [obj, data]);

            jQuery.ajax({
                type: "post",
                dataType: "html",
                cache: false,
                url: pdocrud_js.pdocrudurl + "script/pdocrud.php",
                data: {
                    "pdocrud_data": data,
                    "pdocrud_instance": instance,
                },
                success: function (response) {
                    element.html(response);
                    jQuery(document).trigger("pdocrud_after_reload_ajax_action", [obj, response]);
                    try {
                        grecaptcha.render('pdo_recaptcha', {
                            sitekey: pdocrud_js.site_key,
                            callback: function (response) {
                            }
                        });
                    }
                    catch (err) {
                        // Handle error(s) here
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                },
                complete: function () {
                },
            });
        },
        submitData: function (obj) {
            var data_action_type = jQuery(obj).find(".pdocrud_action_type").val();
            var options = {
                type: "post",
                dataType: "html",
                url: pdocrud_js.pdocrudurl + "script/pdocrud.php",
                beforeSubmit: showRequest, // pre-submit callback 
                success: showResponse  // post-submit callback 
            };
            jQuery(obj).ajaxSubmit(options);

            function showRequest(formData, jqForm, options) {
                jQuery(document).trigger("pdcrud_before_form_submit", [obj, formData]);
                jQuery("#pdocrud-ajax-loader").show();
            }

            function showResponse(responseText, statusText, xhr, jQueryform) {
                jQuery("#pdocrud-ajax-loader").hide();
                jQuery(obj).find(".pdocrud_message").addClass("hidden");
                jQuery(obj).find(".pdocrud_error").addClass("hidden");
                if (data_action_type == "insert" || data_action_type == "update" || data_action_type == "select" || data_action_type == "email" || data_action_type == "selectform") {
                    var response = JSON.parse(responseText);
                    if (response.redirectionurl.length > 0) {
                        window.location.href = response.redirectionurl;
                    }
                    if (response.message.length > 0) {
                        jQuery(obj).find(".pdocrud_message").removeClass("hidden");
                        jQuery(obj).find(".pdocrud_message").find(".message_content").text(response.message);
                    }
                    if (response.error.length > 0) {
                        jQuery(obj).find(".pdocrud_error").removeClass("hidden");
                        jQuery(obj).find(".pdocrud_error").find(".error_content").text(response.error);
                    }
                    
                    if (jQuery(obj).parents(".pdocrud-one-page-container").length > 0) {
                        var op_cont = jQuery(obj).parents(".pdocrud-one-page-container");
                        var instance = op_cont.children().find(".pdocrud-table-container").data("objkey");
                        var data = op_cont.data();
                        var element = op_cont.children().find(".pdocrud-table-container");
                        jQuery.pdocrud_actions.reload(obj, data, instance, element);
                    }
                }
                else if (data_action_type == "insert_back" || data_action_type == "update_back" || data_action_type == "view_back" || data_action_type == "back") {
                    if (jQuery(obj).parents("body").hasClass("modal-open"))
                        jQuery(obj).parents("body").removeClass("modal-open");
                    jQuery('.modal-backdrop').remove();
                    jQuery(obj).closest(".pdocrud-table-container").html(responseText);
                    
                }
                else if (data_action_type === "export") {
                    window.location.href = responseText;
                }
                else {
                    jQuery(obj).closest(".pdocrud-table-container").html(responseText);
                }
                jQuery(document).trigger("pdocrud_after_submission", [obj, responseText]);
            }
        },
        print: function (printdata, printwindow) {
            printwindow.document.write('<html><head><title>Print Data</title>');
            printwindow.document.write('<style type="text/css">.pdocrud-select-cb{display:none} .pdocrud-select-all{display:none}</style>');
            printwindow.document.write('</head><body >');
            printwindow.document.write(printdata);
            printwindow.document.write('</body></html>');
            printwindow.print();
            printwindow.close();
            return true;
        },
        validate: function (form) {
            jQuery(form).find("span.pdocrudform-error").remove();
            jQuery(".form-group").removeClass("has-error");
            var valid = true;
            jQuery(form).find(':input').each(function () {
                jQuery(this).removeClass("has-error");
                jQuery(this).removeClass("pdocruderr");
                if (jQuery(this).data("required")) {
                    if (jQuery(this).val().replace(/\s/g, "") == "") {
                        valid = false;
                        jQuery(this).closest(".form-group").addClass("has-error");
                        jQuery(this).after('<span class="pdocrudform-error field-validation-error" for="' + jQuery(this).attr("id") + '">' + pdocrud_js.lang.req_field + '</span>');
                        jQuery(this).focus();
                    }
                }

                if (jQuery(this).hasAttr("data-email")) {
                    valid = jQuery.pdocrud_actions.validate_email(jQuery(this).val());
                    if (valid === false) {
                        jQuery(this).closest(".form-group").addClass("has-error");
                        jQuery(this).after('<span class="pdocrudform-error field-validation-error" for="' + jQuery(this).attr("id") + '">' + pdocrud_js.lang.invalid_email + '</span>');
                        jQuery(this).focus();
                    }
                }

                if (jQuery(this).hasAttr("data-date")) {
                    valid = jQuery.pdocrud_actions.validate_date(jQuery(this).val());
                    if (valid === false) {
                        jQuery(this).closest(".form-group").addClass("has-error");
                        jQuery(this).after('<span class="pdocrudform-error field-validation-error" for="' + jQuery(this).attr("id") + '">' + pdocrud_js.lang.invalid_date + '</span>');
                        jQuery(this).focus();
                    }
                }

                if (jQuery(this).hasAttr("data-min-length")) {
                    valid = jQuery.pdocrud_actions.validate_length(jQuery(this).data("min-length"), jQuery(this).val().length, "min");
                    if (valid === false) {
                        jQuery(this).closest(".form-group").addClass("has-error");
                        jQuery(this).after('<span class="pdocrudform-error field-validation-error" for="' + jQuery(this).attr("id") + '">' + pdocrud_js.lang.min_length + '</span>');
                        jQuery(this).focus();
                    }
                }

                if (jQuery(this).hasAttr("data-max-length")) {
                    valid = jQuery.pdocrud_actions.validate_length(jQuery(this).data("max-length"), jQuery(this).val().length, "max");
                    if (valid === false) {
                        jQuery(this).closest(".form-group").addClass("has-error");
                        jQuery(this).after('<span class="pdocrudform-error field-validation-error" for="' + jQuery(this).attr("id") + '">' + pdocrud_js.lang.min_length + '</span>');
                        jQuery(this).focus();
                    }
                }


                if (jQuery(this).hasAttr("data-exact-length")) {
                    valid = jQuery.pdocrud_actions.validate_length(jQuery(this).data("exact-length"), jQuery(this).val().length, "exact");
                    if (valid === false) {
                        jQuery(this).closest(".form-group").addClass("has-error");
                        jQuery(this).after('<span class="pdocrudform-error field-validation-error" for="' + jQuery(this).attr("id") + '">' + pdocrud_js.lang.min_length + '</span>');
                        jQuery(this).focus();
                    }
                }

                if (jQuery(this).hasAttr("data-match")) {
                    valid = jQuery.pdocrud_actions.validate_equal_to(jQuery(this).val(), jQuery(jQuery(this).data("equal-to")).val());
                    if (valid === false) {
                        jQuery(this).closest(".form-group").addClass("has-error");
                        jQuery(this).after('<span class="pdocrudform-error field-validation-error" for="' + jQuery(this).attr("id") + '">' + pdocrud_js.lang.match + '</span>');
                        jQuery(this).focus();
                    }
                }

                if (valid === false) {
                    jQuery(this).addClass("pdocruderr");
                    jQuery(this).addClass("has-error");
                }
            });

            return valid;
        },
        validate_email: function (email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (regex.test(email) === false)
                return false;

            return true;
        },
        validate_date: function (date) {
            var matches = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/.exec(date);
            if (matches == null)
                return false;
            var d = matches[2];
            var m = matches[1] - 1;
            var y = matches[3];
            var composedDate = new Date(y, m, d);
            return composedDate.getDate() == d && composedDate.getMonth() == m && composedDate.getFullYear() == y;
        },
        validate_length: function (reqLen, currentLen, operationType) {
            if (operationType === "min")
                return (currentLen >= reqLen);
            else if (operationType === "max")
                return (currentLen <= reqLen);
            else if (operationType === "match")
                return (currentLen == reqLen);
        },
        validate_equal_to: function (val1, val2) {
            if (val1 === val2)
                return true;
            else
                return false;
        },
        getFilterData: function (obj, data) {
            var filter_span = jQuery(obj).closest(".pdocrud-filters-container").find(".pdocrud-filters-options").find(".pdocrud-filter-selected");
            if (filter_span.length > 0) {
                data.filter_data = new Array();
                filter_span.find(".pdocrud-filter-option").each(function () {
                    data.filter_data.push(jQuery(this).data());
                });
            }
            return  data;
        },
        getInstance: function (obj, type) {
            return  jQuery(obj).closest(type).find(".pdoobj").val();
        },
        getDependent: function (obj) {
            return jQuery("select[data-dependent='" + jQuery(obj).attr("id") + "']");
        },
        selectAll: function (obj) {
            if (jQuery(obj).is(":checked"))
                jQuery(obj).parents("table").find(".pdocrud-select-cb").prop('checked', true);
            else
                jQuery(obj).parents("table").find(".pdocrud-select-cb").prop('checked', false);
        },
        createMap: function (obj) {
            jQuery(".pdocrud-gmap").each(function () {
                var mapElemId = jQuery(this).attr("id");
                var googleMapField = jQuery(this).prev();
                var latLng = googleMapField.val().split(',');
                var mapCenter = (latLng.length == 2) ? new google.maps.LatLng(parseFloat(latLng[0]), parseFloat(latLng[1])) : new google.maps.LatLng(51.508742, -0.120850);
                var mapZoom = googleMapField.hasAttr("data-map-zoom") ? googleMapField.data("map-zoom") : 7;
                var mapType = googleMapField.hasAttr("data-map-type") ? googleMapField.data("map-type") : "ROADMAP";

                var mapOptions = {
                    center: mapCenter,
                    zoom: mapZoom,
                    mapTypeId: google.maps.MapTypeId.mapType
                }


                var map = new google.maps.Map(document.getElementById(mapElemId), mapOptions);

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(51.508742, -0.120850),
                    draggable: true,
                    title: "Drag me!"
                });

                google.maps.event.addListener(marker, 'dragend', function () {
                    jQuery(googleMapField).val(this.getPosition().lat() + ',' + this.getPosition().lng());
                });

                marker.setMap(map);

            });
        },
        applyLogic: function (obj, instance, data) {
            var val = jQuery(obj).val();

            var operators = {
                '>': function (a, b) {
                    return a > b
                },
                '=': function (a, b) {
                    return a == b
                },
                '!=': function (a, b) {
                    return a != b
                },
                '<': function (a, b) {
                    return a < b
                }
            };

            for (key in data) {
                var op = data[key].op;
                if (jQuery.isNumeric(val))
                {
                    val = parseInt(val);
                }
                if (jQuery.isNumeric(data[key].condition) && data[key].condition != '0')
                {
                    data[key].condition = parseInt(data[key].condition);
                }
                if (operators[op](val, data[key].condition))
                { 
                    if(data[key].task === "show"){
                        jQuery(":input[name='"+data[key].field.trim()+"']").parent("div.form-group").show();
                    }
                    else if(data[key].task === "hide"){
                        jQuery(":input[name='"+data[key].field.trim()+"']").parent("div.form-group").hide();
                    }
                }                
            }
        },
        loadDependent: function (obj, instance) {
            var dependent = jQuery.pdocrud_actions.getDependent(obj);
            if (dependent.length > 0) {
                jQuery.ajax({
                    type: "post",
                    dataType: "html",
                    cache: false,
                    url: pdocrud_js.pdocrudurl + "script/pdocrud.php",
                    beforeSend: function () {
                        jQuery("#pdocrud-ajax-loader").show();
                    },
                    data: {
                        "pdocrud_data[action]": "loadDependent",
                        "pdocrud_data[pdocrud_dependent_name]": dependent.attr("id"),
                        "pdocrud_data[pdocrud_field_name]": jQuery(obj).attr("id"),
                        "pdocrud_data[pdocrud_field_val]": jQuery(obj).val(),
                        "pdocrud_instance": instance,
                    },
                    success: function (response) {
                        dependent.html(response);
                        jQuery("#pdocrud-ajax-loader").hide();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        jQuery("#pdocrud-ajax-loader").hide();
                    },
                    complete: function () {
                        //console.log()
                    },
                });
            }
        },
    };
    jQuery.pdocrud_actions.init();
});

jQuery.fn.hasAttr = function (name) {
    return this.attr(name) !== undefined;
};

function refreshCaptcha(id, src) {
    jQuery("#" + id).attr("src", src);
}