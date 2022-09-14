<script>

export default {
    layout: AppLayout
}
</script>

<script setup>
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

import AppLayout from '@/Layouts/Guest.vue';
import { defineComponent } from '@vue/runtime-core';


defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <CContainer>
            <CRow class="justify-content-center">
                <CCol :md="8">
                    <CCardGroup>
                        <CCard class="p-4">
                            <CCardBody>
                                <CForm @submit.prevent="submit">
                                    <h1>Login</h1>
                                    <p class="text-medium-emphasis">Sign In to your account</p>
                                    <CInputGroup class="mb-3">
                                        <CInputGroupText>
                                            <CIcon icon="cil-user" />
                                        </CInputGroupText>
                                        <CFormInput placeholder="Username" autocomplete="username" v-model="form.email"
                                            required autofocus />
                                    </CInputGroup>
                                    <input-error :message="form.errors.email" class="mt-2" />
                                    <CInputGroup class="mb-4">
                                        <CInputGroupText>
                                            <CIcon icon="cil-lock-locked" />
                                        </CInputGroupText>
                                        <CFormInput type="password" placeholder="Password"
                                            autocomplete="current-password" v-model="form.password" required />
                                    </CInputGroup>
                                    <CRow>
                                        <CCol :xs="6">
                                            <CButton color="primary" class="px-4" type="submit"
                                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Login
                                                <CSpinner component="span" size="sm" aria-hidden="true"
                                                    v-if="form.processing" />
                                            </CButton>
                                        </CCol>
                                        <CCol :xs="6" class="text-right">

                                        </CCol>
                                    </CRow>
                                </CForm>
                            </CCardBody>
                        </CCard>
                        <CCard class="text-white bg-primary py-5" style="width: 44%">
                            <CCardBody class="text-center">
                                <div>
                                    <h2>Sign up</h2>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna
                                        aliqua.
                                    </p>
                                    <CButton color="light" variant="outline" class="mt-3">
                                        Register Now!
                                    </CButton>
                                </div>
                            </CCardBody>
                        </CCard>
                    </CCardGroup>
                </CCol>
            </CRow>
        </CContainer>
    </div>
</template>
