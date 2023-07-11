export default function (initial) {
    return {
        current: initial,
        history: [],
        isCurrent(id) {
            return this.current === id;
        },
        goTo(id) {
            if (this.current !== null) {
                this.history.push(this.current);
            }

            this.current = id;
        },
        goBack() {
            this.current = this.history.pop();
        },
    };
}
