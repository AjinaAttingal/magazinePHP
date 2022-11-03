function confirmationDelete(anchor)
{
    var conf=confirm('Are you sure wants to delete this rexxcord?');
    if(conf)
    window.location=anchor.attr("href");
}