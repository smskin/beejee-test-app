<template>
    <ul class="pagination">
        <li class="page-item" v-bind:class="{'disabled': page === 1}">
            <a v-on:click.prevent="changePage(page-=1)" class="page-link" href="#">Previous</a>
        </li>
        <li
                v-for="link in links"
                :key="link.id"
                v-bind:class="{'active': link.isCurrent}"
                class="page-item">
            <a v-on:click.prevent="changePage(link.id)" class="page-link" href="#">{{ link.id }}</a>
        </li>
        <li class="page-item" v-bind:class="{'disabled': isLast }">
            <a v-on:click.prevent="changePage(page+=1)" class="page-link" href="#">Next</a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: {
            page: {
                type: Number,
                default: 1
            },
            pages: {
                type: Number,
                default: 1
            }
        },
        computed: {
            isLast(){
                return (this.page >= this.pages);
            },
            links(){
                let ids = [];
                for (let i = 1; i <= this.pages; i++){
                    ids.push({
                        id: i,
                        isCurrent: (this.page === i)
                    });
                }
                return ids;
            }
        },
        methods: {
            changePage(id){
                if (id < 1){
                    return false;
                }

                if (id > this.pages){
                    return false;
                }

                this.$emit('change-page', id)
            }
        }
    }
</script>