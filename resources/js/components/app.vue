<template>
  <div>
    <h1>haii</h1>
    <nav>
      <div>
        <router-link to = '/'>home</router-link>
        <router-link class="link" to ='/about'>about</router-link>
      </div>
    </nav>

    <main>
      <router-view/>
    </main>
  </div>

</template>