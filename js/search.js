function toggleSearch(isOnFocus)
{
    if (isOnFocus) {
        document.body.classList.add("search-focused");
    } else {
        document.body.classList.remove('search-focused');
    }

}
