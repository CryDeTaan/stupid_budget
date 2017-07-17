<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Update Category</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">

                <form id="addAccount">
                    <div class="field">
                        <label class="label">Account Name:</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.categoryName" :placeholder=category[0].categoryName>
                        </p>
                    </div>
                </form>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-primary" @click="onSubmit(category[0].id)">Update Category</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>

    export default {

        props: ['category'],

        data() {
            return {
                form: new Form({
                    categoryName: '',
                })
            }

        },

        methods: {

            onSubmit(categoryId) {
                this.form
                    .put('/categories/' + categoryId)
                    .then(category => this.$emit('completed', category));
            }

        }
    }
</script>