<!-- NavigationComponent.vue -->

<template>
    <div class="nav">
      <!-- Left-side buttons slot -->
      <slot name="left-buttons"></slot>
  
      <!-- Title -->
      <div class="title">
        <slot name="title">Default Title</slot>
      </div>
  
      <!-- Right-side buttons slot -->
      <slot name="right-buttons"></slot>
    </div>
  </template>
  
  <script setup>
  // You can add your component logic here if needed
  </script>
  
  <style scoped>
  .nav {
      display: flex;
      justify-content: space-around;
      margin-top: 50px;
      margin-bottom: 50px;
  }
  </style>
  