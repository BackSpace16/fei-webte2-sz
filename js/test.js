function inputTex(input) {
    var answer = document.getElementById("answer")
    answer.innerHTML = " \\( "+input.value+" \\) "
    MathJax.typeset()
}