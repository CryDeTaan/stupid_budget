<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add Account</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                <form id="addAccount">

                    <div class="field">
                        <label class="label">Name</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.accountName">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Description</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.accountDescription">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Type</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.accountType">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Opening Balance</label>
                        <p class="control">
                            <input class="input" type="number" step="any" v-model="form.openingBalance">
                        </p>
                    </div>
                </form>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-primary" @click="onSubmit()">Add</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                form: new Form({accountName: '', accountDescription: '', accountType: '', openingBalance: ''})
            }

        },

        methods: {

            onSubmit() {

                this.form
                    .post('/accounts/create')
                    .then(account => this.$emit('completed', account));
            }
        }

    }


</script>