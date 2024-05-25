document.addEventListener('DOMContentLoaded', function () {
    let currentUrl = window.location.href;
    let urlSegments = currentUrl.split('/');
    let lastSegment = urlSegments[urlSegments.length - 1];

    if (lastSegment.includes("peminjaman.php")) {
        document.getElementById("nav-home").classList.add("active");
    } else if (lastSegment.includes("books.php")) {
        console.log("masuk sini")
        document.getElementById("nav-book").classList.add("active");
    }
});
