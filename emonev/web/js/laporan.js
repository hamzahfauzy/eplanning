function doPrint()
{
    var _print = $(".print").html()
    var _old = $("body").html()

    $("body").html(_print)
    $("body").css("overflow-x","scroll")
    window.print()
    $("body").html(_old)
}