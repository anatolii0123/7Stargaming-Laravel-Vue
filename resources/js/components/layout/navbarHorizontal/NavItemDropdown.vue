<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fe-grid me-1"></i>
            <slot></slot>
            <div class="arrow-down"></div>
        </a>
            <dynamic-vue-component :content="navCreator(item.children) " v-show="item.children.length"></dynamic-vue-component>
    </li>
</template>

<script>
import Vue from "vue";

export default {
    name: "NavItemDropdown",
    props: ['item'],
    components: {
        DynamicVueComponent: {
            props: {
                content: {
                    type: String,
                    required: true
                }
            },
            render(h) {
                return h(Vue.compile(this.content))
            }
        }
    },
    computed: {
        test() {
            return '<router-link to="test"> mrb </router-link>'
        },

    },
    methods: {
        navCreator(item) {
            // console.log(item)
            var i, htmlNav = '<div class="dropdown-menu" aria-labelledby="topnav-apps" >'
            for (i = 0; i < item.length; i++) {
                if (item[i].children) {
                    htmlNav = htmlNav + '  <div class="dropdown">\n' +
                        '<a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce"\n' +
                        '    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                        '   <i class="fe-shopping-cart me-1"></i> Ecommerce <div class="arrow-down"></div>\n' +
                        '   </a>\n' +
                        '     <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">\n' +
                        '     <a href="ecommerce-dashboard.html" class="dropdown-item">Dashboard</a>\n' +
                        '     </div>\n' +
                        '  </div>'
                } else {

                    // htmlNav = '<a href="apps-chat.html" ><i class="fe-message-square me-1"></i> Chat</a>'
                    htmlNav = htmlNav + '<router-link to="' + item[i].path + '" class="dropdown-item"> ' + item[i].title + ' </router-link>'
                }
            }
            // console.log(htmlNav + 'html hali')
            return htmlNav + '</div>'
        }
    }

}
</script>

<style scoped>

</style>
