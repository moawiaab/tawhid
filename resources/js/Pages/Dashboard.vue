<script setup>

</script>

<template>
    <!-- <Loader v-if="user.loading" /> -->
    <Content title="الرئيسية">
        <template #content>
            <div class="account-locked" v-if="$can('account_locked')">
                account locked
            </div>
            <div class="user-locked" v-else-if="$can('user_locked')">
                user locked
            </div>
            <div class="" v-else>
                default
            </div>
        </template>
    </Content>
</template>

