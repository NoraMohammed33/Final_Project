<template>
    <div class="notifications-container mx-auto w-50">
        <div class="success">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                        <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                </div>
                <div class="success-prompt-wrap">
                    <p class="success-prompt-heading fs-3">Order completed Successfully
                    </p><div class="success-prompt-prompt">
                    <p class="fs-5">Now you can start chat with expert and get your solution.</p>
                </div>
                    <div class="success-button-container">
                        <router-link to="/home">
                            <v-btn color="green">Back Home</v-btn>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SuccessPaymentComponent"
}
</script>

<style scoped>
.notifications-container {
    width: 320px;
    height: auto;
    font-size: 0.875rem;
    line-height: 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.flex {
    display: flex;
}

.flex-shrink-0 {
    flex-shrink: 0;
}

.success {
    padding: 1rem;
    border-radius: 0.375rem;
    background-color: rgb(240 253 244);
}

.succes-svg {
    color: rgb(74 222 128);
    width: 1.25rem;
    height: 1.25rem;
}

.success-prompt-wrap {
    margin-left: 0.75rem;
}

.success-prompt-heading {
    font-weight: bold;
    color: rgb(22 101 52);
}

.success-prompt-prompt {
    margin-top: 0.5rem;
    color: rgb(21 128 61);
}

.success-button-container {
    display: flex;
    margin-top: 0.875rem;
    margin-bottom: -0.375rem;
    margin-left: -0.5rem;
    margin-right: -0.5rem;
}

.success-button-main {
    padding-top: 0.375rem;
    padding-bottom: 0.375rem;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    background-color: #ECFDF5;
    color: rgb(22 101 52);
    font-size: 0.875rem;
    line-height: 1.25rem;
    font-weight: bold;
    border-radius: 0.375rem;
    border: none
}

.success-button-main:hover {
    background-color: #D1FAE5;
}

.success-button-secondary {
    padding-top: 0.375rem;
    padding-bottom: 0.375rem;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    margin-left: 0.75rem;
    background-color: #ECFDF5;
    color: #065F46;
    font-size: 0.875rem;
    line-height: 1.25rem;
    border-radius: 0.375rem;
    border: none;
}
</style>
