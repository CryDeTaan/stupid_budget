<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Update Account</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                Update the any of the following details :</br></br>

                <form id="addAccount">
                    <div class="field">
                        <label class="label">Update Account Name from: {{ account[0].accountName }}</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.accountName">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Update Description from: {{ account[0].accountDescription }} </label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.accountDescription">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Update Account Type from: {{ account[0].accountType }}</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.accountType">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Update Account Balance from: {{ account[0].balance }}</label>
                        <p class="control">
                            <input class="input" type="number" step="any" v-model="form.balance">
                        </p>
                    </div>
                </form>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-danger" @click="onSubmit(account[0].id)">Update Account</a>
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
                    .put('/accounts/' + accountId);
                    this.$emit('completed', accountId);
            }

        }
    }
</script>