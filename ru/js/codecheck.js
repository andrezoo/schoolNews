class instruments {

                  strip_tags(str, allowed_tags) {
                    var key = '', allowed = false;
                    var matches = [];
                    var allowed_array = [];
                    var allowed_tag = '';
                    var i = 0;
                    var k = '';
                    var html = '';

                    var replacer = function(search, replace, str) {
                      return str.split(search).join(replace);
                    };

                    if (allowed_tags) allowed_array = allowed_tags.match(/([a-zA-Z]+)/gi);

                    str += '';

                    matches = str.match(/(<\/?[\S][^>]*>)/gi);

                    for (key in matches) {
                      if (isNaN(key)) {
                      // IE7 Hack
                      continue;
                    }

                    html = matches[key].toString();

                    allowed = false;

                    for (k in allowed_array) {

                      allowed_tag = allowed_array[k];
                      i = -1;

                      if (i != 0) { i = html.toLowerCase().indexOf('<'+allowed_tag+'>');}
                      if (i != 0) { i = html.toLowerCase().indexOf('<'+allowed_tag+' ');}
                      if (i != 0) { i = html.toLowerCase().indexOf('</'+allowed_tag)   ;}

                      // Determine
                      if (i == 0) {
                          allowed = true;
                          break;
                      }
                  }

                  if (!allowed) str = replacer(html, "", str);

              }

              return str;
            }

                  openThis(obj) {
                    if(obj.className = "selecttype") {

                      if($(obj).attr('full') == 'true') $(obj).attr('full', 'false');
                      else $(obj).attr('full', 'true');

                    }
                  }

                  getSelection() {
                    if(window.getSelection().focusNode) {
                      if(window.getSelection().focusNode.parentNode.tagName !== "H1") {

                        if (typeof window.getSelection() != "undefined") return window.getSelection();
                        else if (typeof document.getSelection() != "undefined" && document.getSelection().type == "Text") return document.getSelection();

                      } else return false;
                    }
                  }

                  setBold() {

                    if(getSelection()) {

                      var sel = getSelection();

                      //alert(sel.anchorOffset);

                      if(sel.anchorNode.parentNode.textContent) {

                        var content = sel.anchorNode.parentNode.textContent;

                        var f, s, t;

                        if(content.length == (sel.anchorOffset || sel.focusOffset)) {

                          if(content.length == sel.anchorOffset) {f = ''; t = ''; s = '<b>' + content.substr(sel.focusOffset, sel.anchorOffset) + '</b>'}
                          else {f = ''; t = ''; s = '<b>' + content.substr(sel.anchorOffset, sel.focusOffset) + '</b>'};

                        } else {

                          if(sel.anchorOffset > sel.focusOffset) {
                            if(sel.focusOffset) f = content.substr(0, sel.focusOffset); else f = '';
                            s = '<b>' + content.substr(sel.focusOffset, sel.anchorOffset - 1) + '</b>';
                            if(sel.anchorOffset !== content.length) t = content.substr(sel.anchorOffset, content.length); else t = '';

                            if(content != f + s + t) {
                              if(sel.focusOffset) f = content.substr(0, sel.focusOffset); else f = '';
                              s = '<b>' + content.substr(sel.focusOffset, sel.anchorOffset) + '</b>';
                              if(sel.anchorOffset !== content.length) t = content.substr(sel.anchorOffset, content.length); else t = '';

                              if(content != f + s + t) {
                                if(sel.focusOffset) f = content.substr(0, sel.focusOffset); else f = '';
                                s = '<b>' + content.substr(sel.focusOffset, sel.anchorOffset) + '</b>';
                                if(sel.anchorOffset !== content.length) t = content.substr(sel.anchorOffset, content.length); else t = '';

                                if(content != f + s + t) {

                                  if(sel.focusOffset) f = content.substr(0, sel.focusOffset); else f = '';
                                  s = '<b>' + content.substr(sel.focusOffset, sel.anchorOffset - 1) + '</b>';
                                  if(sel.anchorOffset !== content.length) t = content.substr(sel.anchorOffset, content.length); else t = '';

                                }

                              }

                            }

                          } else {
                            if(sel.focusOffset) f = content.substr(0, sel.anchorOffset); else f = '';
                            s = '<b>' + content.substr(sel.anchorOffset, sel.focusOffset - 1) + '</b>';
                            if(sel.anchorOffset !== content.length) t = content.substr(sel.focusOffset, content.length); else t = '';

                            if(content != f + s + t) {
                              if(sel.focusOffset) f = content.substr(0, sel.anchorOffset); else f = '';
                              s = '<b>' + content.substr(sel.anchorOffset, sel.focusOffset) + '</b>';
                              if(sel.anchorOffset !== content.length) t = content.substr(sel.focusOffset, content.length); else t = '';

                              if(content != f + s + t) {
                                if(sel.focusOffset) f = content.substr(0, sel.anchorOffset); else f = '';
                                s = '<b>' + content.substr(sel.anchorOffset, sel.focusOffset) + '</b>';
                                if(sel.anchorOffset !== content.length) t = content.substr(sel.focusOffset, content.length); else t = '';

                                if(content != f + s + t) {
                                  if(sel.focusOffset) f = content.substr(0, sel.anchorOffset); else f = '';
                                  s = '<b>' + content.substr(sel.anchorOffset, sel.focusOffset - 1) + '</b>';
                                  if(sel.anchorOffset !== content.length) t = content.substr(sel.focusOffset, content.length); else t = '';

                                }

                              }

                            }

                          }

                        }

                        $(sel.anchorNode.parentNode).html('');

                        $(sel.anchorNode).append(f + s + t);

                      }

                    }

                  }

                  setItal() {

                    if(getSelection()) {

                      var sel = getSelection();

                      //alert(sel.anchorOffset);

                      if(sel.anchorNode.parentNode.textContent) {

                        var content = sel.anchorNode.parentNode.textContent;

                        var f, s, t;

                        if(content.length == (sel.anchorOffset || sel.focusOffset)) {

                          if(content.length == sel.anchorOffset) {f = ''; t = ''; s = '<em>' + content.substr(sel.focusOffset, sel.anchorOffset) + '</em>'}
                          else {f = ''; t = ''; s = '<em>' + content.substr(sel.anchorOffset, sel.focusOffset) + '</em>'};

                        } else {

                          if(sel.anchorOffset > sel.focusOffset) {
                            if(sel.focusOffset) f = content.substr(0, sel.focusOffset); else f = '';
                            s = '<em>' + content.substr(sel.focusOffset, sel.anchorOffset - 1) + '</em>';
                            if(sel.anchorOffset !== content.length) t = content.substr(sel.anchorOffset, content.length); else t = '';

                            if(content != f + s + t) {
                              if(sel.focusOffset) f = content.substr(0, sel.focusOffset); else f = '';
                              s = '<em>' + content.substr(sel.focusOffset, sel.anchorOffset) + '</em>';
                              if(sel.anchorOffset !== content.length) t = content.substr(sel.anchorOffset, content.length); else t = '';

                              if(content != f + s + t) {
                                if(sel.focusOffset) f = content.substr(0, sel.focusOffset); else f = '';
                                s = '<em>' + content.substr(sel.focusOffset, sel.anchorOffset) + '</em>';
                                if(sel.anchorOffset !== content.length) t = content.substr(sel.anchorOffset, content.length); else t = '';

                                if(content != f + s + t) {

                                  if(sel.focusOffset) f = content.substr(0, sel.focusOffset); else f = '';
                                  s = '<em>' + content.substr(sel.focusOffset, sel.anchorOffset - 1) + '</em>';
                                  if(sel.anchorOffset !== content.length) t = content.substr(sel.anchorOffset, content.length); else t = '';

                                }

                              }

                            }

                          } else {
                            if(sel.focusOffset) f = content.substr(0, sel.anchorOffset); else f = '';
                            s = '<em>' + content.substr(sel.anchorOffset, sel.focusOffset - 1) + '</em>';
                            if(sel.anchorOffset !== content.length) t = content.substr(sel.focusOffset, content.length); else t = '';

                            if(content != f + s + t) {
                              if(sel.focusOffset) f = content.substr(0, sel.anchorOffset); else f = '';
                              s = '<em>' + content.substr(sel.anchorOffset, sel.focusOffset) + '</em>';
                              if(sel.anchorOffset !== content.length) t = content.substr(sel.focusOffset, content.length); else t = '';

                              if(content != f + s + t) {
                                if(sel.focusOffset) f = content.substr(0, sel.anchorOffset); else f = '';
                                s = '<em>' + content.substr(sel.anchorOffset, sel.focusOffset) + '</em>';
                                if(sel.anchorOffset !== content.length) t = content.substr(sel.focusOffset, content.length); else t = '';

                                if(content != f + s + t) {
                                  if(sel.focusOffset) f = content.substr(0, sel.anchorOffset); else f = '';
                                  s = '<em>' + content.substr(sel.anchorOffset, sel.focusOffset - 1) + '</em>';
                                  if(sel.anchorOffset !== content.length) t = content.substr(sel.focusOffset, content.length); else t = '';

                                }

                              }

                            }

                          }

                        }

                        $(sel.anchorNode.parentNode).html('');

                        $(sel.anchorNode).append(f + s + t);

                      }

                    }

                  }

                  setStrike() {

                    if(getSelection()) {

                      var sel = getSelection();

                      if(sel.anchorNode.parentNode.textContent) {

                        var content = sel.anchorNode.parentNode.textContent;

                        var f, s, t, negative;

                        if(content.length == (sel.anchorOffset || sel.focusOffset)) {

                          if(content.length == sel.anchorOffset) {f = ''; t = ''; s = '<strike>' + content.substr(sel.focusOffset, sel.anchorOffset) + '</strike>'}
                          else {f = ''; t = ''; s = '<strike>' + content.substr(sel.anchorOffset, sel.focusOffset) + '</strike>'};

                        } else {

                          if(sel.anchorOffset > sel.focusOffset) {
                            if(sel.focusOffset) f = content.substr(0, sel.focusOffset); else f = '';
                            s = '<strike>' + content.substr(sel.focusOffset, sel.anchorOffset - 1) + '</strike>';
                            if(sel.anchorOffset !== content.length) t = content.substr(sel.anchorOffset, content.length); else t = '';

                            if(content != f + s + t) {
                              if(sel.focusOffset) f = content.substr(0, sel.focusOffset); else f = '';
                              s = '<strike>' + content.substr(sel.focusOffset, sel.anchorOffset) + '</strike>';
                              if(sel.anchorOffset !== content.length) t = content.substr(sel.anchorOffset, content.length); else t = '';

                              if(content != f + s + t) {
                                if(sel.focusOffset) f = content.substr(0, sel.focusOffset); else f = '';
                                s = '<strike>' + content.substr(sel.focusOffset, sel.anchorOffset) + '</strike>';
                                if(sel.anchorOffset !== content.length) t = content.substr(sel.anchorOffset, content.length); else t = '';

                                if(content != f + s + t) {

                                  if(sel.focusOffset) f = content.substr(0, sel.focusOffset); else f = '';
                                  s = '<strike>' + content.substr(sel.focusOffset, sel.anchorOffset - 1) + '</strike>';
                                  if(sel.anchorOffset !== content.length) t = content.substr(sel.anchorOffset, content.length); else t = '';

                                }

                              }

                            }

                          } else {
                            if(sel.focusOffset) f = content.substr(0, sel.anchorOffset); else f = '';
                            s = '<strike>' + content.substr(sel.anchorOffset, sel.focusOffset - 1) + '</strike>';
                            if(sel.anchorOffset !== content.length) t = content.substr(sel.focusOffset, content.length); else t = '';

                            if(content != f + s + t) {
                              if(sel.focusOffset) f = content.substr(0, sel.anchorOffset); else f = '';
                              s = '<strike>' + content.substr(sel.anchorOffset, sel.focusOffset) + '</strike>';
                              if(sel.anchorOffset !== content.length) t = content.substr(sel.focusOffset, content.length); else t = '';

                              if(content != f + s + t) {
                                if(sel.focusOffset) f = content.substr(0, sel.anchorOffset); else f = '';
                                s = '<strike>' + content.substr(sel.anchorOffset, sel.focusOffset) + '</strike>';
                                if(sel.anchorOffset !== content.length) t = content.substr(sel.focusOffset, content.length); else t = '';

                                if(content != f + s + t) {
                                  if(sel.focusOffset) f = content.substr(0, sel.anchorOffset); else f = '';
                                  s = '<strike>' + content.substr(sel.anchorOffset, sel.focusOffset - 1) + '</strike>';
                                  if(sel.anchorOffset !== content.length) t = content.substr(sel.focusOffset, content.length); else t = '';

                                }

                              }

                            }

                          }

                        }

                        $(sel.anchorNode.parentNode).html('');

                        $(sel.anchorNode).append(f + s + t);

                      }

                    }

                  }

                }

                let i = new instruments();
