<template>
  <div class="d-flex justify-center align-center animation-container">
    <h1 ref="header" class="header-animation">Sample Website</h1>
  </div>
</template>

<script>
export default {
  methods: {
    clearTimer (timer) {
      clearInterval(timer)
    },

    doAnimation () {
      const header = this.$refs.header
      const headerChars = header.textContent.split('')

      let currentHeader = ""
      headerChars.forEach((element,i) => {
        currentHeader += `<span>${element}</span>`
        header.innerHTML += currentHeader
      });
      header.innerHTML = currentHeader

      const letterList = document.querySelectorAll('span')
      let letter = 0
      let timer = setInterval(() => {
        letterList[letter].classList.add('animated')
        letter++
        if(headerChars.length === letter) this.clearTimer(timer)
      }, 200)
    }
  },

  mounted () {
    this.doAnimation()
  }
}
</script>

<style>
section, .row, .col {
  height: inherit;
}
.animation-container {
  height: 100%;
}

.header-animation span {
  opacity: 0;
  color: white;
  margin-top: 100;
  transition: all 0.5s ease;
  display: inline-block;
  transform: translateY(100px);
}

.header-animation span.animated {
  opacity: 1;
  transform: translateY(0);
}
</style>