// loadMenu.js
document.addEventListener('DOMContentLoaded', function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/source/header.html', true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById('menuContainer').innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  });

  document.addEventListener('DOMContentLoaded', function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/source/footer.html', true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById('menuFooter').innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  });

  document.addEventListener('DOMContentLoaded', function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/source/leave.html', true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById('leave_comment').innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  });
  