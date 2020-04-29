<template>
    <div class="vx-card" ref="card" v-on="$listeners">
        <div class="vx-card__header" v-if="hasHeader">
            <div class="vx-card__title">
                <h4 v-if="this.$props.title" :style="titleStyles" :class="titleClasses">{{ title }}</h4>
                <h6 v-if="this.$props.subtitle" :style="subtitleStyles" :class="subtitleClasses">{{ subtitle }}</h6>
            </div>
            <div class="vx-card__actions" v-if="hasAction">
                <slot name="actions">

                </slot>
            </div>
        </div>
        <div class="vx-card__collapsible-content vs-con-loading__container" ref="content">
            <slot name="no-body"></slot>

            <div class="vx-card__body" v-if="this.$slots.default">
                <slot></slot>
            </div>

            <slot name="no-body-bottom"></slot>

            <div class="vx-card__footer" v-if="this.$slots.footer">
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        title: String,
        subtitle: String,
        actionButtons: {
            type: Boolean,
            default: false,
        },
        actionButtonsColor: {
            type: String,
            default: "success",
        },
        codeToggler: {
            type: Boolean,
            default: false,
        },
        noShadow: {
            default: false,
            type: Boolean,
        },
        noRadius: {
            default: false,
            type: Boolean,
        },
        cardBorder: {
            default: false,
            type: Boolean,
        },
        collapseAction: {
            default: false,
            type: Boolean
        },
        refreshContentAction: {
            default: false,
            type: Boolean
        },
        removeCardAction: {
            default: false,
            type: Boolean
        },
        headerBackground: {
          default: '',
          type: String
        },
        cardBackground: {
          default: '',
          type: String
        },
        contentColor: {
          default: '',
          type: String
        },
        titleColor: {
          default: '',
          type: String
        },
        subtitleColor: {
          default: '#b8c2cc',
          type: String
        }
    },
    computed: {
        hasAction() {
            return this.$slots.actions || (this.actionButtons || this.collapseAction || this.refreshContentAction || this.removeCardAction || this.codeToggler)
        },
        hasHeader() {
            return this.hasAction || (this.title || this.subtitle)
        },
    }
}
</script>