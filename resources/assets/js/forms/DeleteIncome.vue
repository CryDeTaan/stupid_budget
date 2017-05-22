<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Delete Income</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                Are you sure you want to delete the following Income from your profile:</br></br>
                <strong>  Income Date : </strong>
                {{ income[0].created_at }}</br>
                <strong>  Income Description : </strong>
                {{ income[0].incomeDescription }}</br>
                <strong>  Income Belongs to Account : </strong>
                {{ income[0].account.accountName }}</br>
                <strong>  Income Amount  : </strong>
                {{ income[0].amount}}
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-danger" @click="onSubmit(income[0].id)">Delete Income</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['income'],
        methods: {
            onSubmit(incomeId) {
                axios.delete('/income/' + incomeId);
                this.$emit('completed', incomeId);
            }
        }
    }
</script>