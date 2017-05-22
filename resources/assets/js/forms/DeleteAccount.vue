<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Delete Account</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                Are you sure you want to delete the following account:</br></br>
                <strong>  Account Name : </strong>
                {{ account[0].accountName }}</br>
                <strong>  Account Type  : </strong>
                {{ account[0].accountType }}</br>
                <strong>  Account Balance  : </strong>
                {{ account[0].balance }}
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-danger" @click="onSubmit(account[0].id)">Delete Account</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['account'],
        methods: {
            onSubmit(accountId) {
                axios.delete('/accounts/' + accountId);
                this.$emit('completed', accountId);
            }
        }
    }
</script>