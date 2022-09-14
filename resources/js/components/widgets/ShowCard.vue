<template>
    <!-- <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="w_summary">
                    <div class="s_chart">
                        <span class="chart">5,2,3,6,9,8,4,1,2,8</span>
                    </div>
                    <div class="s_detail">
                        <h2 class="font700 mb-0">${{ amount }}</h2>
                        <span>{{ total }}% <i class="fa fa-level-up text-success"></i>{{ title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg text-white rounded-circle" :class="color">
                        <i class="fa" :class="icon"></i>
                    </div>
                    <div class="ml-4">
                        <span>{{ title }}</span>
                        <h4 class="mb-0 font-weight-medium">{{ amount }} ج </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    amount: String,
    icon: { type: String, default: "fa-bar-chart-o" },
    color: { type: String, default: "bg-indigo" },
})
</script>
