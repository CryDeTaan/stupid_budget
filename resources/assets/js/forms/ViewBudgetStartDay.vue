<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Update Budget Start Day</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">

                <form id="addAccount">
                    <div class="field">
                        <label class="label">Day of Month:</label>
                        <p class="control">
                            <input class="input" type="number" min="1" max="31" v-model="form.budgetStartDay" :placeholder=budgetStartDay>
                        </p>
                    </div>
                </form>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-primary" @click="onSubmit()">Update</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>

    export default {

        props: ['budgetStartDay'],

        data() {
            return {
                form: new Form({
                    budgetStartDay: '',
                })
            }

        },

        methods: {

            onSubmit() {
                this.form
                    .put('/categories/jouma/budget') //dankie @leonjza
                    .then(categories => this.$emit('completed', categories));
            }

        }
    }
</script>