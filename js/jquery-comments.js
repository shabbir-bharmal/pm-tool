/*!     jquery-comments.js 1.4.0
 *
 *     (c) 2017 Joona Tykkyläinen, Viima Solutions Oy
 *     jquery-comments may be freely distributed under the MIT license.
 *     For all details and documentation:
 *     http://viima.github.io/jquery-comments/
 */
!function (n) {
    "function" == typeof define && define.amd ? define(["jquery"], n) : "object" == typeof module && module.exports ? module.exports = function (e, t) {
        return void 0 === t && (t = "undefined" != typeof window ? require("jquery") : require("jquery")(e)), n(t), t
    } : n(jQuery)
}(function (F) {
    var n = {
        $el                             : null,
        commentsById                    : {},
        dataFetched                     : !1,
        currentSortKey                  : "",
        options                         : {},
        events                          : {
            click                                                        : "closeDropdowns",
            "keydown [contenteditable]"                                  : "saveOnKeydown",
            "focus [contenteditable]"                                    : "saveEditableContent",
            "keyup [contenteditable]"                                    : "checkEditableContentForChange",
            "paste [contenteditable]"                                    : "checkEditableContentForChange",
            "input [contenteditable]"                                    : "checkEditableContentForChange",
            "blur [contenteditable]"                                     : "checkEditableContentForChange",
            "click .navigation li[data-sort-key]"                        : "navigationElementClicked",
            "click .navigation li.title"                                 : "toggleNavigationDropdown",
            "click .commenting-field.main .textarea"                     : "showMainCommentingField",
            "click .commenting-field.main .close"                        : "hideMainCommentingField",
            "click .commenting-field .textarea"                          : "increaseTextareaHeight",
            "change .commenting-field .textarea"                         : "increaseTextareaHeight textareaContentChanged",
            "click .commenting-field:not(.main) .close"                  : "removeCommentingField",
            "click .commenting-field .send.enabled"                      : "postComment",
            "click .commenting-field .update.enabled"                    : "putComment",
            "click .commenting-field .delete.enabled"                    : "deleteComment",
            'change .commenting-field .upload.enabled input[type="file"]': "fileInputChanged",
            "click li.comment button.upvote"                             : "upvoteComment",
            "click li.comment button.delete.enabled"                     : "deleteComment",
            "click li.comment .hashtag"                                  : "hashtagClicked",
            "click li.comment .ping"                                     : "pingClicked",
            "click li.comment ul.child-comments .toggle-all"             : "toggleReplies",
            "click li.comment button.reply"                              : "replyButtonClicked",
            "click li.comment button.edit"                               : "editButtonClicked",
            dragenter                                                    : "showDroppableOverlay",
            "dragenter .droppable-overlay"                               : "handleDragEnter",
            "dragleave .droppable-overlay"                               : "handleDragLeaveForOverlay",
            "dragenter .droppable-overlay .droppable"                    : "handleDragEnter",
            "dragleave .droppable-overlay .droppable"                    : "handleDragLeaveForDroppable",
            "dragover .droppable-overlay"                                : "handleDragOverForOverlay",
            "drop .droppable-overlay"                                    : "handleDrop",
            "click .dropdown.autocomplete"                               : "stopPropagation",
            "mousedown .dropdown.autocomplete"                           : "stopPropagation",
            "touchstart .dropdown.autocomplete"                          : "stopPropagation"
        },
        getDefaultOptions               : function () {
            return {
                profilePictureURL               : "",
                currentUserIsAdmin              : !1,
                currentUserId                   : null,
                spinnerIconURL                  : "",
                upvoteIconURL                   : "",
                replyIconURL                    : "",
                uploadIconURL                   : "",
                attachmentIconURL               : "",
                fileIconURL                     : "",
                noCommentsIconURL               : "",
                textareaPlaceholderText         : "Add a comment",
                newestText                      : "Newest",
                oldestText                      : "Oldest",
                popularText                     : "Popular",
                attachmentsText                 : "Attachments",
                sendText                        : "Send",
                replyText                       : "Reply",
                editText                        : "Edit",
                editedText                      : "Edited",
                youText                         : "You",
                saveText                        : "Save",
                deleteText                      : "Delete",
                newText                         : "New",
                viewAllRepliesText              : "View all __replyCount__ replies",
                hideRepliesText                 : "Hide replies",
                noCommentsText                  : "No comments",
                noAttachmentsText               : "No attachments",
                attachmentDropText              : "Drop files here",
                textFormatter                   : function (e) {
                    return e
                },
                enableReplying                  : !0,
                enableEditing                   : !0,
                enableUpvoting                  : !0,
                enableDeleting                  : !0,
                enableAttachments               : !1,
                enableHashtags                  : !1,
                enablePinging                   : !1,
                enableDeletingCommentWithReplies: !1,
                enableNavigation                : !0,
                postCommentOnEnter              : !1,
                forceResponsive                 : !1,
                readOnly                        : !1,
                defaultNavigationSortKey        : "newest",
                highlightColor                  : "#2793e6",
                deleteButtonColor               : "#C9302C",
                scrollContainer                 : this.$el,
                roundProfilePictures            : !1,
                textareaRows                    : 2,
                textareaRowsOnFocus             : 2,
                textareaMaxRows                 : 5,
                maxRepliesVisible               : 2,
                fieldMappings                   : {
                    id                  : "id",
                    parent              : "parent",
                    created             : "created",
                    modified            : "modified",
                    content             : "content",
                    file                : "file",
                    fileURL             : "file_url",
                    fileMimeType        : "file_mime_type",
                    pings               : "pings",
                    creator             : "creator",
                    fullname            : "fullname",
                    profileURL          : "profile_url",
                    profilePictureURL   : "profile_picture_url",
                    isNew               : "is_new",
                    createdByAdmin      : "created_by_admin",
                    createdByCurrentUser: "created_by_current_user",
                    upvoteCount         : "upvote_count",
                    userHasUpvoted      : "user_has_upvoted"
                },
                searchUsers                     : function (e, t, n) {
                    t([])
                },
                getComments                     : function (e, t) {
                    e([])
                },
                postComment                     : function (e, t, n) {
                    t(e)
                },
                putComment                      : function (e, t, n) {
                    t(e)
                },
                deleteComment                   : function (e, t, n) {
                    t()
                },
                upvoteComment                   : function (e, t, n) {
                    t(e)
                },
                hashtagClicked                  : function (e) {
                },
                pingClicked                     : function (e) {
                },
                uploadAttachments               : function (e, t, n) {
                    t(e)
                },
                refresh                         : function () {
                },
                timeFormatter                   : function (e) {
                    return new Date(e).toLocaleDateString()
                }
            }
        },
        init                            : function (e, t) {
            var n;
            this.$el = F(t), this.$el.addClass("jquery-comments"), this.undelegateEvents(), this.delegateEvents(), n = navigator.userAgent || navigator.vendor || window.opera, (jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(n) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(n.substr(0, 4)), F.browser.mobile && this.$el.addClass("mobile"), this.options = F.extend(!0, {}, this.getDefaultOptions(), e), this.options.readOnly && this.$el.addClass("read-only"), this.currentSortKey = this.options.defaultNavigationSortKey, this.createCssDeclarations(), this.fetchDataAndRender()
        },
        delegateEvents                  : function () {
            this.bindEvents(!1)
        },
        undelegateEvents                : function () {
            this.bindEvents(!0)
        },
        bindEvents                      : function (e) {
            var t = e ? "off" : "on";
            for (var n in this.events) {
                var a = n.split(" ")[0],
                    i = n.split(" ").slice(1).join(" "),
                    o = this.events[n].split(" ");
                for (var r in o)
                    if (o.hasOwnProperty(r)) {
                        var s = this[o[r]];
                        s = F.proxy(s, this), "" == i ? this.$el[t](a, s) : this.$el[t](a, i, s)
                    }
            }
        },
        fetchDataAndRender              : function () {
            var n = this;
            this.commentsById = {}, this.$el.empty(), this.createHTML(), this.options.getComments(function (e) {
                var t = e.map(function (e) {
                    return n.createCommentModel(e)
                });
                n.sortComments(t, "oldest"), F(t).each(function (e, t) {
                    n.addCommentToDataModel(t)
                }), n.dataFetched = !0, n.render()
            })
        },
        fetchNext                       : function () {
            var n = this,
                t = this.createSpinner();
            this.$el.find("ul#comment-list").append(t);
            this.options.getComments(function (e) {
                F(e).each(function (e, t) {
                    n.createComment(t)
                }), t.remove()
            }, function () {
                t.remove()
            })
        },
        createCommentModel              : function (e) {
            var t = this.applyInternalMappings(e);
            return t.childs = [], t
        },
        addCommentToDataModel           : function (e) {
            e.id in this.commentsById || (this.commentsById[e.id] = e).parent && this.getOutermostParent(e.parent).childs.push(e.id)
        },
        updateCommentModel              : function (e) {
            F.extend(this.commentsById[e.id], e)
        },
        render                          : function () {
            this.dataFetched && (this.showActiveContainer(), this.createComments(), this.options.enableAttachments && this.createAttachments(), this.$el.find("> .spinner").remove(), this.options.refresh())
        },
        showActiveContainer             : function () {
            var e = this.$el.find(".navigation li[data-container-name].active").data("container-name"),
                t = this.$el.find('[data-container="' + e + '"]');
            t.siblings("[data-container]").hide(), t.show()
        },
        createComments                  : function () {
            var n = this;
            this.$el.find("#comment-list").remove();
            var a = F("<ul/>", {
                    id   : "comment-list",
                    class: "main"
                }),
                i = [],
                o = [];
            F(this.getComments()).each(function (e, t) {
                null == t.parent ? i.push(t) : o.push(t)
            }), this.sortComments(i, this.currentSortKey), i.reverse(), F(i).each(function (e, t) {
                n.addComment(t, a)
            }), this.sortComments(o, "oldest"), F(o).each(function (e, t) {
                n.addComment(t, a)
            }), this.$el.find('[data-container="comments"]').prepend(a)
        },
        createAttachments               : function () {
            var n = this;
            this.$el.find("#attachment-list").remove();
            var a = F("<ul/>", {
                    id   : "attachment-list",
                    class: "main"
                }),
                e = this.getAttachments();
            this.sortComments(e, "newest"), e.reverse(), F(e).each(function (e, t) {
                n.addAttachment(t, a)
            }), this.$el.find('[data-container="attachments"]').prepend(a)
        },
        addComment                      : function (e, t) {
            t = t || this.$el.find("#comment-list");
            var n = this.createCommentElement(e);
            if (e.parent) {
                var a = t.find('.comment[data-id="' + e.parent + '"]');
                this.reRenderCommentActionBar(e.parent);
                var i = a.parents(".comment").last();
                0 == i.length && (i = a);
                var o = i.find(".child-comments"),
                    r = o.find(".commenting-field");
                r.length ? r.before(n) : o.append(n), this.updateToggleAllButton(i)
            } else "newest" == this.currentSortKey ? t.prepend(n) : t.append(n)
        },
        addAttachment                   : function (e, t) {
            t = t || this.$el.find("#attachment-list");
            var n = this.createCommentElement(e);
            t.prepend(n)
        },
        removeComment                   : function (e) {
            var n = this,
                t = this.commentsById[e],
                a = this.getChildComments(t.id);
            if (F(a).each(function (e, t) {
                n.removeComment(t.id)
            }), t.parent) {
                var i = this.getOutermostParent(t.parent),
                    o = i.childs.indexOf(t.id);
                i.childs.splice(o, 1)
            }
            delete this.commentsById[e];
            var r = this.$el.find('li.comment[data-id="' + e + '"]'),
                s = r.parents("li.comment").last();
            r.remove(), this.updateToggleAllButton(s)
        },
        uploadAttachments               : function (e, t) {
            var a = this,
                n = (t = t || this.$el.find(".commenting-field.main")).find(".upload"),
                i = !t.hasClass("main"),
                o = e.length;
            if (o) {
                var r = t.find(".textarea");
                n.removeClass("enabled");
                var s = this.createSpinner(),
                    l = this.createSpinner();
                this.$el.find("ul#attachment-list").prepend(s), i ? t.before(l) : this.$el.find("ul#comment-list").prepend(l);
                var c = [];
                F(e).each(function (e, t) {
                    var n = a.createCommentJSON(r);
                    n.id += "-" + e, n.content = "", n.file = t, n.fileURL = wroot + "/upload/" + t.name, n.fileMimeType = t.type, n = a.applyExternalMappings(n), c.push(n)
                }), a.options.uploadAttachments(c, function (e) {
                    F(e).each(function (e, t) {
                        var n = a.createCommentModel(t);
                        a.addCommentToDataModel(n), a.addComment(n), a.addAttachment(n)
                    }), e.length == o && 0 == a.getTextareaContent(r).length && t.find(".close").trigger("click"), n.addClass("enabled"), l.remove(), s.remove()
                }, function () {
                    n.addClass("enabled"), l.remove(), s.remove()
                })
            }
            n.find("input").val("")
        },
        updateToggleAllButton           : function (e) {
            if (null != this.options.maxRepliesVisible) {
                var t = e.find(".child-comments"),
                    n = t.find(".comment").not(".hidden"),
                    a = t.find("li.toggle-all");
                if (n.removeClass("togglable-reply"), 0 === this.options.maxRepliesVisible) var i = n;
                else i = n.slice(0, -this.options.maxRepliesVisible);
                if (i.addClass("togglable-reply"), a.find("span.text").text() == this.options.textFormatter(this.options.hideRepliesText) && i.addClass("visible"), n.length > this.options.maxRepliesVisible) {
                    if (!a.length) {
                        a = F("<li/>", {
                            class: "toggle-all highlight-font-bold"
                        });
                        var o = F("<span/>", {
                                class: "text"
                            }),
                            r = F("<span/>", {
                                class: "caret"
                            });
                        a.append(o).append(r), t.prepend(a)
                    }
                    this.setToggleAllButtonText(a, !1)
                } else a.remove()
            }
        },
        updateToggleAllButtons          : function () {
            var n = this,
                e = this.$el.find("#comment-list");
            e.find(".comment").removeClass("visible"), e.children(".comment").each(function (e, t) {
                n.updateToggleAllButton(F(t))
            })
        },
        sortComments                    : function (e, i) {
            var o = this;
            "popularity" == i ? e.sort(function (e, t) {
                var n = e.childs.length,
                    a = t.childs.length;
                if (o.options.enableUpvoting && (n += e.upvoteCount, a += t.upvoteCount), a != n) return a - n;
                var i = new Date(e.created).getTime();
                return new Date(t.created).getTime() - i
            }) : e.sort(function (e, t) {
                var n = new Date(e.created).getTime(),
                    a = new Date(t.created).getTime();
                return "oldest" == i ? n - a : a - n
            })
        },
        sortAndReArrangeComments        : function (e) {
            var a = this.$el.find("#comment-list"),
                t = this.getComments().filter(function (e) {
                    return !e.parent
                });
            this.sortComments(t, e), F(t).each(function (e, t) {
                var n = a.find("> li.comment[data-id=" + t.id + "]");
                a.append(n)
            })
        },
        showActiveSort                  : function () {
            var e = this.$el.find('.navigation li[data-sort-key="' + this.currentSortKey + '"]');
            this.$el.find(".navigation li").removeClass("active"), e.addClass("active");
            var t = this.$el.find(".navigation .title");
            if ("attachments" != this.currentSortKey) t.addClass("active"), t.find("header").html(e.first().html());
            else {
                var n = this.$el.find(".navigation ul.dropdown").children().first();
                t.find("header").html(n.html())
            }
            this.showActiveContainer()
        },
        forceResponsive                 : function () {
            this.$el.addClass("responsive")
        },
        closeDropdowns                  : function () {
            this.$el.find(".dropdown").hide()
        },
        saveOnKeydown                   : function (e) {
            if (13 == e.keyCode) {
                var t = e.metaKey || e.ctrlKey;
                if (this.options.postCommentOnEnter || t) F(e.currentTarget).siblings(".control-row").find(".save").trigger("click"), e.stopPropagation(), e.preventDefault()
            }
        },
        saveEditableContent             : function (e) {
            var t = F(e.currentTarget);
            t.data("before", t.html())
        },
        checkEditableContentForChange   : function (e) {
            var t = F(e.currentTarget);
            F(t[0].childNodes).each(function () {
                this.nodeType == Node.TEXT_NODE && 0 == this.length && this.removeNode && this.removeNode()
            }), t.data("before") != t.html() && (t.data("before", t.html()), t.trigger("change"))
        },
        navigationElementClicked        : function (e) {
            var t = F(e.currentTarget).data().sortKey;
            "attachments" != t && this.sortAndReArrangeComments(t), this.currentSortKey = t, this.showActiveSort()
        },
        toggleNavigationDropdown        : function (e) {
            e.stopPropagation(), F(e.currentTarget).find("~ .dropdown").toggle()
        },
        showMainCommentingField         : function (e) {
            var t = F(e.currentTarget);
            t.siblings(".control-row").show(), t.parent().find(".close").show(), t.parent().find(".upload.inline-button").hide(), t.focus()
        },
        hideMainCommentingField         : function (e) {
            var t = F(e.currentTarget),
                n = this.$el.find(".commenting-field.main .textarea"),
                a = this.$el.find(".commenting-field.main .control-row");
            this.clearTextarea(n), this.adjustTextareaHeight(n, !1), a.hide(), t.hide(), n.parent().find(".upload.inline-button").show(), n.blur()
        },
        increaseTextareaHeight          : function (e) {
            var t = F(e.currentTarget);
            this.adjustTextareaHeight(t, !0)
        },
        textareaContentChanged          : function (e) {
            var t = F(e.currentTarget),
                n = t.siblings(".control-row").find(".save");
            if (!t.find(".reply-to.tag").length)
                if (t.attr("data-comment")) {
                    var a = t.parents("li.comment");
                    if (1 < a.length) {
                        var i = a.last().data("id");
                        t.attr("data-parent", i)
                    }
                } else {
                    i = t.parents("li.comment").last().data("id");
                    t.attr("data-parent", i)
                }
            var o = t.parents(".commenting-field").first();
            t[0].scrollHeight > t.outerHeight() ? o.addClass("commenting-field-scrollable") : o.removeClass("commenting-field-scrollable");
            var r = !0,
                s = this.getTextareaContent(t, !0);
            if (commentModel = this.commentsById[t.attr("data-comment")]) {
                var l, c = s != commentModel.content;
                commentModel.parent && (l = commentModel.parent.toString());
                var d = t.attr("data-parent") != l;
                r = c || d
            }
            s.length && r ? n.addClass("enabled") : n.removeClass("enabled")
        },
        removeCommentingField           : function (e) {
            var t = F(e.currentTarget);
            t.siblings(".textarea").attr("data-comment") && t.parents("li.comment").first().removeClass("edit"), t.parents(".commenting-field").first().remove()
        },
        postComment                     : function (e) {
            var t = this,
                n = F(e.currentTarget),
                a = n.parents(".commenting-field").first(),
                i = a.find(".textarea");
            n.removeClass("enabled");
            var o = this.createCommentJSON(i);
            o = this.applyExternalMappings(o);
            this.options.postComment(o, function (e) {
                t.createComment(e), a.find(".close").trigger("click")
            }, function () {
                n.addClass("enabled")
            })
        },
        createComment                   : function (e) {
            var t = this.createCommentModel(e);
            this.addCommentToDataModel(t), this.addComment(t)
        },
        putComment                      : function (e) {
            var n = this,
                t = F(e.currentTarget),
                a = t.parents(".commenting-field").first(),
                i = a.find(".textarea");
            t.removeClass("enabled");
            var o = F.extend({}, this.commentsById[i.attr("data-comment")]);
            F.extend(o, {
                parent  : i.attr("data-parent") || null,
                content : this.getTextareaContent(i),
                pings   : this.getPings(i),
                modified: (new Date).getTime()
            }), o = this.applyExternalMappings(o);
            this.options.putComment(o, function (e) {
                var t = n.createCommentModel(e);
                delete t.childs, n.updateCommentModel(t), a.find(".close").trigger("click"), n.reRenderComment(t.id)
            }, function () {
                t.addClass("enabled")
            })
        },
        deleteComment                   : function (e) {
            var t = this,
                n = F(e.currentTarget),
                a = n.parents(".comment").first(),
                i = F.extend({}, this.commentsById[a.attr("data-id")]),
                o = i.id,
                r = i.parent;
            n.removeClass("enabled"), i = this.applyExternalMappings(i);
            this.options.deleteComment(i, function () {
                t.removeComment(o), r && t.reRenderCommentActionBar(r)
            }, function () {
                n.addClass("enabled")
            })
        },
        hashtagClicked                  : function (e) {
            var t = F(e.currentTarget).attr("data-value");
            this.options.hashtagClicked(t)
        },
        pingClicked                     : function (e) {
            var t = F(e.currentTarget).attr("data-value");
            this.options.pingClicked(t)
        },
        fileInputChanged                : function (e, t) {
            t = e.currentTarget.files;
            var n = F(e.currentTarget).parents(".commenting-field").first();
            this.uploadAttachments(t, n)
        },
        upvoteComment                   : function (e) {
            var t, n = this,
                a = F(e.currentTarget).parents("li.comment").first().data().model,
                i = a.upvoteCount;
            t = a.userHasUpvoted ? i - 1 : i + 1, a.userHasUpvoted = !a.userHasUpvoted, a.upvoteCount = t, this.reRenderUpvotes(a.id);
            var o = F.extend({}, a);
            o = this.applyExternalMappings(o);
            this.options.upvoteComment(o, function (e) {
                var t = n.createCommentModel(e);
                n.updateCommentModel(t), n.reRenderUpvotes(t.id)
            }, function () {
                a.userHasUpvoted = !a.userHasUpvoted, a.upvoteCount = i, n.reRenderUpvotes(a.id)
            })
        },
        toggleReplies                   : function (e) {
            var t = F(e.currentTarget);
            t.siblings(".togglable-reply").toggleClass("visible"), this.setToggleAllButtonText(t, !0)
        },
        replyButtonClicked              : function (e) {
            var t = F(e.currentTarget),
                n = t.parents("li.comment").last(),
                a = t.parents(".comment").first().data().id,
                i = n.find(".child-comments > .commenting-field");
            if (i.length && i.remove(), i.find(".textarea").attr("data-parent") != a) {
                i = this.createCommentingFieldElement(a), n.find(".child-comments").append(i);
                var o = i.find(".textarea");
                this.moveCursorToEnd(o);
                var r = this.options.scrollContainer.scrollTop(),
                    s = r + i.position().top + i.outerHeight(),
                    l = r + this.options.scrollContainer.outerHeight();
                if (l < s) {
                    var c = r + (s - l);
                    this.options.scrollContainer.scrollTop(c)
                }
            }
        },
        editButtonClicked               : function (e) {
            var t = F(e.currentTarget).parents("li.comment").first(),
                n = t.data().model;
            t.addClass("edit");
            var a = this.createCommentingFieldElement(n.parent, n.id);
            t.find(".comment-wrapper").first().append(a);
            var i = a.find(".textarea");
            i.attr("data-comment", n.id), i.append(this.getFormattedCommentContent(n, !0)), this.moveCursorToEnd(i)
        },
        showDroppableOverlay            : function (e) {
            this.options.enableAttachments && (this.$el.find(".droppable-overlay").css("top", this.$el[0].scrollTop), this.$el.find(".droppable-overlay").show(), this.$el.addClass("drag-ongoing"))
        },
        handleDragEnter                 : function (e) {
            var t = F(e.currentTarget).data("dnd-count") || 0;
            t++, F(e.currentTarget).data("dnd-count", t), F(e.currentTarget).addClass("drag-over")
        },
        handleDragLeave                 : function (e, t) {
            var n = F(e.currentTarget).data("dnd-count");
            n--, F(e.currentTarget).data("dnd-count", n), 0 == n && (F(e.currentTarget).removeClass("drag-over"), t && t())
        },
        handleDragLeaveForOverlay       : function (e) {
            var t = this;
            this.handleDragLeave(e, function () {
                t.hideDroppableOverlay()
            })
        },
        handleDragLeaveForDroppable     : function (e) {
            this.handleDragLeave(e)
        },
        handleDragOverForOverlay        : function (e) {
            e.stopPropagation(), e.preventDefault(), e.originalEvent.dataTransfer.dropEffect = "copy"
        },
        hideDroppableOverlay            : function () {
            this.$el.find(".droppable-overlay").hide(), this.$el.removeClass("drag-ongoing")
        },
        handleDrop                      : function (e) {
            e.preventDefault(), F(e.target).trigger("dragleave"), this.hideDroppableOverlay(), this.uploadAttachments(e.originalEvent.dataTransfer.files)
        },
        stopPropagation                 : function (e) {
            e.stopPropagation()
        },
        createHTML                      : function () {
            var e = this.createMainCommentingFieldElement();
            this.$el.append(e), e.find(".control-row").hide(), e.find(".close").hide(), this.options.enableNavigation && (this.$el.append(this.createNavigationElement()), this.showActiveSort());
            var t = this.createSpinner();
            this.$el.append(t);
            var n = F("<div/>", {
                class           : "data-container",
                "data-container": "comments"
            });
            this.$el.append(n);
            var a = F("<div/>", {
                    class: "no-comments no-data",
                    text : this.options.textFormatter(this.options.noCommentsText)
                }),
                i = F("<i/>", {
                    class: "fa fa-comments fa-2x"
                });
            if (this.options.noCommentsIconURL.length && (i.css("background-image", 'url("' + this.options.noCommentsIconURL + '")'), i.addClass("image")), a.prepend(F("<br/>")).prepend(i), n.append(a), this.options.enableAttachments) {
                var o = F("<div/>", {
                    class           : "data-container",
                    "data-container": "attachments"
                });
                this.$el.append(o);
                var r = F("<div/>", {
                        class: "no-attachments no-data",
                        text : this.options.textFormatter(this.options.noAttachmentsText)
                    }),
                    s = F("<i/>", {
                        class: "fa fa-paperclip fa-2x"
                    });
                this.options.attachmentIconURL.length && (s.css("background-image", 'url("' + this.options.attachmentIconURL + '")'), s.addClass("image")), r.prepend(F("<br/>")).prepend(s), o.append(r);
                var l = F("<div/>", {
                        class: "droppable-overlay"
                    }),
                    c = F("<div/>", {
                        class: "droppable-container"
                    }),
                    d = F("<div/>", {
                        class: "droppable"
                    }),
                    p = F("<i/>", {
                        class: "fa fa-paperclip fa-4x"
                    });
                this.options.uploadIconURL.length && (p.css("background-image", 'url("' + this.options.uploadIconURL + '")'), p.addClass("image"));
                var m = F("<div/>", {
                    text: this.options.textFormatter(this.options.attachmentDropText)
                });
                d.append(p), d.append(m), l.html(c.html(d)).hide(), this.$el.append(l)
            }
        },
        createProfilePictureElement     : function (e, t) {
            if (e) var n = F("<div/>").css({
                "background-image": "url(" + e + ")"
            });
            else n = F("<i/>", {
                class: "fa fa-user"
            });
            return n.addClass("profile-picture"), n.attr("data-user-id", t), this.options.roundProfilePictures && n.addClass("round"), n
        },
        createMainCommentingFieldElement: function () {
            return this.createCommentingFieldElement(void 0, void 0, !0)
        },
        createCommentingFieldElement    : function (e, t, n) {
            var l = this,
                a = F("<div/>", {
                    class: "commenting-field"
                });
            if (n && a.addClass("main"), t) var i = this.commentsById[t].profilePictureURL,
                o = this.commentsById[t].creator;
            else i = this.options.profilePictureURL, o = this.options.creator;
            var r = this.createProfilePictureElement(i, o),
                s = F("<div/>", {
                    class: "textarea-wrapper"
                }),
                c = F("<div/>", {
                    class: "control-row"
                }),
                d = F("<div/>", {
                    class             : "textarea",
                    "data-placeholder": this.options.textFormatter(this.options.textareaPlaceholderText),
                    contenteditable   : !0
                });
            this.adjustTextareaHeight(d, !1);
            var p = F("<span/>", {
                class: "close inline-button"
            }).append(F('<span class="left"/>')).append(F('<span class="right"/>'));
            if (t) {
                var m = this.options.textFormatter(this.options.saveText),
                    h = F("<span/>", {
                        class: "delete",
                        text : this.options.textFormatter(this.options.deleteText)
                    }).css("background-color", this.options.deleteButtonColor);
                c.append(h), this.isAllowedToDelete(t) && h.addClass("enabled")
            } else {
                m = this.options.textFormatter(this.options.sendText);
                if (this.options.enableAttachments) {
                    var u = F("<span/>", {
                            class: "enabled upload"
                        }),
                        f = F("<i/>", {
                            class: "fa fa-paperclip"
                        }),
                        g = F("<input/>", {
                            type       : "file",
                            "data-role": "none"
                        });
                    F.browser.mobile || g.attr("multiple", "multiple"), this.options.uploadIconURL.length && (f.css("background-image", 'url("' + this.options.uploadIconURL + '")'), f.addClass("image")), u.append(f).append(g), c.append(u.clone()), n && s.append(u.clone().addClass("inline-button"))
                }
            }
            var v = F("<span/>", {
                class: (t ? "update" : "send") + " save highlight-background",
                text : m
            });
            if (c.prepend(v), s.append(p).append(d).append(c), a.append(r).append(s), e) {
                d.attr("data-parent", e);
                var C = this.commentsById[e];
                if (C.parent) {
                    d.html("&nbsp;");
                    var b = "@" + C.fullname,
                        x = this.createTagElement(b, "reply-to", C.creator, {
                            "data-user-id": C.creator
                        });
                    d.prepend(x)
                }
            }
            return this.options.enablePinging && (d.textcomplete([{
                match   : /(^|\s)@([^@]*)$/i,
                index   : 2,
                search  : function (e, t) {
                    e = l.normalizeSpaces(e);
                    l.options.searchUsers(e, t, function () {
                        t([])
                    })
                },
                template: function (e) {
                    var t = F("<div/>"),
                        n = l.createProfilePictureElement(e.profile_picture_url),
                        a = F("<div/>", {
                            class: "details"
                        }),
                        i = F("<div/>", {
                            class: "name"
                        }).html(e.fullname),
                        o = F("<div/>", {
                            class: "email"
                        }).html(e.email);
                    return e.email ? a.append(i).append(o) : (a.addClass("no-email"), a.append(i)), t.append(n).append(a), t.html()
                },
                replace : function (e) {
                    return " " + l.createTagElement("@" + e.fullname, "ping", e.id, {
                        "data-user-id": e.id
                    })[0].outerHTML + " "
                }
            }], {
                appendTo         : ".jquery-comments",
                dropdownClassName: "dropdown autocomplete",
                maxCount         : 5,
                rightEdgeOffset  : 0,
                debounce         : 250
            }), F.fn.textcomplete.Dropdown.prototype.render = function (e) {
                var t = this._buildContents(e),
                    n = F.map(e, function (e) {
                        return e.value
                    });
                console.log(e);
                if (e.length) {
                    var a = e[0].strategy;
                    a.id ? this.$el.attr("data-strategy", a.id) : this.$el.removeAttr("data-strategy"), this._renderHeader(n), this._renderFooter(n), t && (this._renderContents(t), this._fitToBottom(), this._fitToRight(), this._activateIndexedItem()), this._setScroll()
                } else this.noResultsMessage ? this._renderNoResultsMessage(n) : this.shown && this.deactivate();
                var i = parseInt(this.$el.css("top")) + l.options.scrollContainer.scrollTop();
               // this.$el.css("top", i);
               /* i = i + 20;
                console.log(i);*/
                this.$el.css("top", 0);
                this.$el.css("position", "absolute");
                var o = this.$el.css("left");
                this.$el.css("left", 0);
                var r = l.$el.width() - this.$el.outerWidth(),
                    s = Math.min(r, parseInt(o));
                this.$el.css("left", s)
            }, F.fn.textcomplete    .ContentEditable.prototype._skipSearch = function (e) {
                switch (e.keyCode) {
                    case 9:
                    case 13:
                    case 16:
                    case 17:
                    case 33:
                    case 34:
                    case 40:
                    case 38:
                    case 27:
                        return !0
                }
                if (e.ctrlKey) switch (e.keyCode) {
                    case 78:
                    case 80:
                        return !0
                }
            }), a
        },
        createNavigationElement         : function () {
            var e = F("<ul/>", {
                    class: "navigation"
                }),
                t = F("<div/>", {
                    class: "navigation-wrapper"
                });
            e.append(t);
            var n = F("<li/>", {
                    text                 : this.options.textFormatter(this.options.newestText),
                    "data-sort-key"      : "newest",
                    "data-container-name": "comments"
                }),
                a = F("<li/>", {
                    text                 : this.options.textFormatter(this.options.oldestText),
                    "data-sort-key"      : "oldest",
                    "data-container-name": "comments"
                }),
                i = F("<li/>", {
                    text                 : this.options.textFormatter(this.options.popularText),
                    "data-sort-key"      : "popularity",
                    "data-container-name": "comments"
                }),
                o = F("<li/>", {
                    text                 : this.options.textFormatter(this.options.attachmentsText),
                    "data-sort-key"      : "attachments",
                    "data-container-name": "attachments"
                }),
                r = F("<i/>", {
                    class: "fa fa-paperclip"
                });
            this.options.attachmentIconURL.length && (r.css("background-image", 'url("' + this.options.attachmentIconURL + '")'), r.addClass("image")), o.prepend(r);
            var s = F("<div/>", {
                    class: "navigation-wrapper responsive"
                }),
                l = F("<ul/>", {
                    class: "dropdown"
                }),
                c = F("<li/>", {
                    class: "title"
                }),
                d = F("<header/>");
            return c.append(d), s.append(c), s.append(l), e.append(s), t.append(n).append(a), l.append(n.clone()).append(a.clone()), (this.options.enableReplying || this.options.enableUpvoting) && (t.append(i), l.append(i.clone())), this.options.enableAttachments && (t.append(o), s.append(o.clone())), this.options.forceResponsive && this.forceResponsive(), e
        },
        createSpinner                   : function () {
            var e = F("<div/>", {
                    class: "spinner"
                }),
                t = F("<i/>", {
                    class: "fa fa-spinner fa-spin"
                });
            return this.options.spinnerIconURL.length && (t.css("background-image", 'url("' + this.options.spinnerIconURL + '")'), t.addClass("image")), e.html(t), e
        },
        createCommentElement            : function (e) {
            var t = F("<li/>", {
                "data-id": e.id,
                class    : "comment"
            }).data("model", e);
            e.createdByCurrentUser && t.addClass("by-current-user"), e.createdByAdmin && t.addClass("by-admin");
            var n = F("<ul/>", {
                    class: "child-comments"
                }),
                a = this.createCommentWrapperElement(e);
            return t.append(a), null == e.parent && t.append(n), t
        },
        createCommentWrapperElement     : function (e) {
            var t = F("<div/>", {
                    class: "comment-wrapper"
                }),
                n = this.createProfilePictureElement(e.profilePictureURL, e.creator),
                a = F("<time/>", {
                    text           : this.options.timeFormatter(e.created),
                    "data-original": e.created
                }),
                i = F("<span/>", {
                    "data-user-id": e.creator,
                    text          : e.createdByCurrentUser ? this.options.textFormatter(this.options.youText) : e.fullname
                });
            e.profileURL && (i = F("<a/>", {
                href: e.profileURL,
                html: i
            }));
            var o = F("<div/>", {
                class: "name",
                html : i
            });
            if (e.createdByAdmin && o.addClass("highlight-font-bold"), e.parent) {
                var r = this.commentsById[e.parent];
                if (r.parent) {
                    var s = F("<span/>", {
                            class         : "reply-to",
                            text          : r.fullname,
                            "data-user-id": r.creator
                        }),
                        l = F("<i/>", {
                            class: "fa fa-share"
                        });
                    this.options.replyIconURL.length && (l.css("background-image", 'url("' + this.options.replyIconURL + '")'), l.addClass("image")), s.prepend(l), o.append(s)
                }
            }
            if (e.isNew) {
                var c = F("<span/>", {
                    class: "new highlight-background",
                    text : this.options.textFormatter(this.options.newText)
                });
                o.append(c)
            }
            var d = F("<div/>", {
                    class: "wrapper"
                }),
                p = F("<div/>", {
                    class: "content"
                }),
                m = null != e.fileURL;
            if (m) {
                var h = null,
                    u = null;
                if (e.fileMimeType) {
                    var f = e.fileMimeType.split("/");
                    2 == f.length && (h = f[1], u = f[0])
                }
                var g = F("<a/>", {
                    class : "attachment",
                    href  : e.fileURL,
                    target: "_blank"
                });
                if ("image" == u) {
                    var v = F("<img/>", {
                        src: e.fileURL
                    });
                    g.html(v)
                } else if ("video" == u) {
                    var C = F("<video/>", {
                        src     : e.fileURL,
                        type    : e.fileMimeType,
                        controls: "controls"
                    });
                    g.html(C)
                } else {
                    var b = ["archive", "audio", "code", "excel", "image", "movie", "pdf", "photo", "picture", "powerpoint", "sound", "video", "word", "zip"],
                        x = "fa fa-file-o";
                    0 < b.indexOf(h) ? x = "fa fa-file-" + h + "-o" : 0 < b.indexOf(u) && (x = "fa fa-file-" + u + "-o");
                    var y = F("<i/>", {
                        class: x
                    });
                    this.options.fileIconURL.length && (y.css("background-image", 'url("' + this.options.fileIconURL + '")'), y.addClass("image"));
                    var w = e.fileURL.split("/"),
                        T = w[w.length - 1];
                    T = T.split("?")[0], T = decodeURIComponent(T), g.text(T), g.prepend(y)
                }
                p.html(g)
            } else p.html(this.getFormattedCommentContent(e));
            if (e.modified && e.modified != e.created) {
                var k = this.options.timeFormatter(e.modified),
                    R = F("<time/>", {
                        class          : "edited",
                        text           : this.options.textFormatter(this.options.editedText) + " " + k,
                        "data-original": e.modified
                    });
                p.append(R)
            }
            var U = F("<span/>", {
                    class: "actions"
                }),
                $ = F("<span/>", {
                    class: "separator",
                    text : ""
                }),
                E = F("<button/>", {
                    class: "action reply",
                    type : "button",
                    text : this.options.textFormatter(this.options.replyText)
                }),
                A = F("<i/>", {
                    class: "fa fa-thumbs-up"
                });
            this.options.upvoteIconURL.length && (A.css("background-image", 'url("' + this.options.upvoteIconURL + '")'), A.addClass("image"));
            var I = this.createUpvoteElement(e);
            if (this.options.enableReplying && U.append(E), this.options.enableUpvoting && U.append(I), e.createdByCurrentUser || this.options.currentUserIsAdmin)
                if (m && this.isAllowedToDelete(e.id)) {
                    var D = F("<button/>", {
                        class: "action delete enabled",
                        text : this.options.textFormatter(this.options.deleteText)
                    });
                    U.append(D)
                } else if (!m && this.options.enableEditing) {
                    var L = F("<button/>", {
                        class: "action edit",
                        type : "button",
                        text : this.options.textFormatter(this.options.editText)
                    });
                    U.append(L)
                }
            return U.children().each(function (e, t) {
                F(t).is(":last-child") || F(t).after($.clone())
            }), d.append(p), d.append(U), t.append(n).append(a).append(o).append(d), t
        },
        createUpvoteElement             : function (e) {
            var t = F("<i/>", {
                class: "fa fa-thumbs-up"
            });
            return this.options.upvoteIconURL.length && (t.css("background-image", 'url("' + this.options.upvoteIconURL + '")'), t.addClass("image")), F("<button/>", {
                class: "action upvote d-none" + (e.userHasUpvoted ? " highlight-font" : "")
            }).append(F("<span/>", {
                text : e.upvoteCount,
                class: "upvote-count"
            })).append(t)
        },
        createTagElement                : function (e, t, n, a) {
            var i = F("<input/>", {
                class      : "tag",
                type       : "button",
                "data-role": "none"
            });
            return t && i.addClass(t), i.val(e), i.attr("data-value", n), a && i.attr(a), i
        },
        reRenderComment                 : function (e) {
            var a = this.commentsById[e],
                t = this.$el.find('li.comment[data-id="' + a.id + '"]'),
                i = this;
            t.each(function (e, t) {
                var n = i.createCommentWrapperElement(a);
                F(t).find(".comment-wrapper").first().replaceWith(n)
            })
        },
        reRenderCommentActionBar        : function (e) {
            var a = this.commentsById[e],
                t = this.$el.find('li.comment[data-id="' + a.id + '"]'),
                i = this;
            t.each(function (e, t) {
                var n = i.createCommentWrapperElement(a);
                F(t).find(".actions").first().replaceWith(n.find(".actions"))
            })
        },
        reRenderUpvotes                 : function (e) {
            var a = this.commentsById[e],
                t = this.$el.find('li.comment[data-id="' + a.id + '"]'),
                i = this;
            t.each(function (e, t) {
                var n = i.createUpvoteElement(a);
                F(t).find(".upvote").first().replaceWith(n)
            })
        },
        createCssDeclarations           : function () {
            F("head style.jquery-comments-css").remove(), this.createCss(".jquery-comments ul.navigation li.active:after {background: " + this.options.highlightColor + " !important;", NaN), this.createCss(".jquery-comments ul.navigation ul.dropdown li.active {background: " + this.options.highlightColor + " !important;", NaN), this.createCss(".jquery-comments .highlight-background {background: " + this.options.highlightColor + " !important;", NaN), this.createCss(".jquery-comments .highlight-font {color: " + this.options.highlightColor + " !important;}"), this.createCss(".jquery-comments .highlight-font-bold {color: " + this.options.highlightColor + " !important;font-weight: bold;}")
        },
        createCss                       : function (e) {
            var t = F("<style/>", {
                type : "text/css",
                class: "jquery-comments-css",
                text : e
            });
            F("head").append(t)
        },
        getComments                     : function () {
            var t = this;
            return Object.keys(this.commentsById).map(function (e) {
                return t.commentsById[e]
            })
        },
        getChildComments                : function (t) {
            return this.getComments().filter(function (e) {
                return e.parent == t
            })
        },
        getAttachments                  : function () {
            return this.getComments().filter(function (e) {
                return null != e.fileURL
            })
        },
        getOutermostParent              : function (e) {
            var t = e;
            do {
                var n = this.commentsById[t];
                t = n.parent
            } while (null != n.parent);
            return n
        },
        createCommentJSON               : function (e) {
            var t = (new Date).toISOString();
            return {
                //id                  : (this.getComments().length + 1),
                parent              : e.attr("data-parent") || null,
                created             : t,
                modified            : t,
                content             : this.getTextareaContent(e),
                pings               : this.getPings(e),
                fullname            : this.options.textFormatter(this.options.youText),
                profilePictureURL   : this.options.profilePictureURL,
                createdByCurrentUser: !0,
                upvoteCount         : 0,
                userHasUpvoted      : !1
            }
        },
        isAllowedToDelete               : function (n) {
            if (this.options.enableDeleting) {
                var a = !0;
                return this.options.enableDeletingCommentWithReplies || F(this.getComments()).each(function (e, t) {
                    t.parent == n && (a = !1)
                }), a
            }
            return !1
        },
        setToggleAllButtonText          : function (n, e) {
            function t() {
                var e = a.options.textFormatter(a.options.viewAllRepliesText),
                    t = n.siblings(".comment").not(".hidden").length;
                e = e.replace("__replyCount__", t), i.text(e)
            }

            var a = this,
                i = n.find("span.text"),
                o = n.find(".caret"),
                r = this.options.textFormatter(this.options.hideRepliesText);
            e ? (i.text() == r ? t() : i.text(r), o.toggleClass("up")) : i.text() != r && t()
        },
        adjustTextareaHeight            : function (e, t) {
            e = F(e);
            var n, a = 1 == t ? this.options.textareaRowsOnFocus : this.options.textareaRows;
            do {
                void 0, n = 2.2 + 1.45 * (a - 1), e.css("height", n + "em"), a++;
                var i = e[0].scrollHeight > e.outerHeight(),
                    o = 0 != this.options.textareaMaxRows && a > this.options.textareaMaxRows
            } while (i && !o)
        },
        clearTextarea                   : function (e) {
            e.empty().trigger("input")
        },
        getTextareaContent              : function (e, t) {
            var n = e.clone();
            n.find(".reply-to.tag").remove(), n.find(".tag.hashtag").replaceWith(function () {
                return t ? F(this).val() : "#" + F(this).attr("data-value")
            }), n.find(".tag.ping").replaceWith(function () {
                return t ? F(this).val() : "@" + F(this).attr("data-value")
            });
            var a = F("<pre/>").html(n.html());
            a.find("div, p, br").replaceWith(function () {
                return "\n" + this.innerHTML
            });
            var i = a.text().replace(/^\s+/g, "");
            return i = this.normalizeSpaces(i)
        },
        getFormattedCommentContent      : function (e, t) {
            var n = this.escape(e.content);
            return n = this.linkify(n), n = this.highlightTags(e, n), t && (n = n.replace(/(?:\n)/g, "<br>")), n
        },
        getPings                        : function (e) {
            var i = {};
            return e.find(".ping").each(function (e, t) {
                var n = parseInt(F(t).attr("data-value")),
                    a = F(t).val();
                i[n] = a.slice(1)
            }), i
        },
        moveCursorToEnd                 : function (e) {
            if (e = F(e)[0], F(e).trigger("input"), F(e).scrollTop(e.scrollHeight), void 0 !== window.getSelection && void 0 !== document.createRange) {
                var t = document.createRange();
                t.selectNodeContents(e), t.collapse(!1);
                var n = window.getSelection();
                n.removeAllRanges(), n.addRange(t)
            } else if (void 0 !== document.body.createTextRange) {
                var a = document.body.createTextRange();
                a.moveToElementText(e), a.collapse(!1), a.select()
            }
            e.focus()
        },
        escape                          : function (e) {
            return F("<pre/>").text(this.normalizeSpaces(e)).html()
        },
        normalizeSpaces                 : function (e) {
            return e.replace(new RegExp(" ", "g"), " ")
        },
        after                           : function (e, t) {
            var n = this;
            return function () {
                if (0 == --e) return t.apply(n, arguments)
            }
        },
        highlightTags                   : function (e, t) {
            return this.options.enableHashtags && (t = this.highlightHashtags(e, t)), this.options.enablePinging && (t = this.highlightPings(e, t)), t
        },
        highlightHashtags               : function (e, t) {
            var a = this;
            if (-1 != t.indexOf("#")) {
                t = t.replace(/(^|\s)#([a-zäöüß\d-_]+)/gim, function (e, t, n) {
                    return t + function (e) {
                        return (e = a.createTagElement("#" + e, "hashtag", e))[0].outerHTML
                    }(n)
                })
            }
            return t
        },
        highlightPings                  : function (a, i) {
            var o = this;
            if (-1 != i.indexOf("@")) {
                F(Object.keys(a.pings)).each(function (e, t) {
                    var n = "@" + a.pings[t];
                    i = i.replace(new RegExp(n, "g"), function (e, t) {
                        return o.createTagElement(e, "ping", t, {
                            "data-user-id": t
                        })[0].outerHTML
                    }(n, t))
                })
            }
            return i
        },
        linkify                         : function (e) {
            var t, n, a, i;
            if (n = /(\b(https?|ftp|file):\/\/[-A-ZÄÖÅ0-9+&@#\/%?=~_|!:,.;]*[-A-ZÄÖÅ0-9+&@#\/%=~_|])/gim, a = /(^|[^\/f])(www\.[-A-ZÄÖÅ0-9+&@#\/%?=~_|!:,.;]*[-A-ZÄÖÅ0-9+&@#\/%=~_|])/gim, i = /(([A-ZÄÖÅ0-9\-\_\.])+@[A-ZÄÖÅ\_]+?(\.[A-ZÄÖÅ]{2,6})+)/gim, t = (t = (t = e.replace(n, '<a href="$1" target="_blank">$1</a>')).replace(a, '$1<a href="https://$2" target="_blank">$2</a>')).replace(i, '<a href="mailto:$1">$1</a>'), 0 < (e.match(/<a href/g) || []).length) {
                for (var o = e.split(/(<\/a>)/g), r = 0; r < o.length; r++) null == o[r].match(/<a href/g) && (o[r] = o[r].replace(n, '<a href="$1" target="_blank">$1</a>').replace(a, '$1<a href="https://$2" target="_blank">$2</a>').replace(i, '<a href="mailto:$1">$1</a>'));
                return o.join("")
            }
            return t
        },
        waitUntil                       : function (e, t) {
            var n = this;
            e() ? t() : setTimeout(function () {
                n.waitUntil(e, t)
            }, 100)
        },
        applyInternalMappings           : function (e) {
            var t = {},
                n = this.options.fieldMappings;
            for (var a in n) n.hasOwnProperty(a) && (t[n[a]] = a);
            return this.applyMappings(t, e)
        },
        applyExternalMappings           : function (e) {
            var t = this.options.fieldMappings;
            return this.applyMappings(t, e)
        },
        applyMappings                   : function (e, t) {
            var n = {};
            for (var a in t) {
                if (a in e) n[e[a]] = t[a]
            }
            return n
        }
    };
    F.fn.comments = function (t) {
        return this.each(function () {
            var e = Object.create(n);
            F.data(this, "comments", e), e.init(t || {}, this)
        })
    }
});
