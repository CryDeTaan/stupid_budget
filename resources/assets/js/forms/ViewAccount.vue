<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Update Account</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                <form id="addAccount">
                    <div class="field">
                        <label class="label">Account Name:</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.accountName" :placeholder="account.accountName">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Description:</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.accountDescription" :placeholder="account.accountDescription">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Account Type:</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.accountType" :placeholder="account.accountType">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Account Balance:</label>
                        <p class="control">
                            <input class="input" type="number" step="any" v-model="form.balance" :placeholder="account.balance">
                        </p>
                    </div>
                </form>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-warning" @click="onSubmit(account.id)">Update Account</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>

    export default {

        props: ['account'],

        data() {
            return {
                form: new Form({
                    accountName: '',
                    accountDescription: '',
                    accountType: '',
                    balance: ''
                })
            }

        },

        methods: {

            onSubmit(accountId) {
                this.form
                    .put('/accounts/' + accountId)
                    .then(account => this.$emit('completed', account));
            }

        }
    }
</script>