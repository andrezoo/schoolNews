function Copytoclipboard(text) {

  var selection = window.getSelection();
  var range = document.createRange();
  range.selectNodeContents(text);
  selection.removeAllRanges();
  selection.addRange(range);

  document.execCommand('copy');

  createAlert('Скопировано в буфер: ' + $(text).text(), 750);

}
