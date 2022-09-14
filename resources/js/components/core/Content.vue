<template>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12 text-left hidden-xs">
                        <h2>{{ title }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <slot name="header" />
                                <li class="breadcrumb-item active" aria-current="page">{{ title }}</li>
                            </ol>
                        </nav>
                        <!-- <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" title="">Add New</a> -->

                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <slot name="add" />
                    </div>

                </div>
            </div>
            <event-hub />
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">

                    <slot name="content" />

                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({ title: String })

</script>

<style>
</style>
