export default {
    required: (v) => !!v || "Toto pole je povinné",
    requiredSelectTag: (v) => v.length > 0 || "Zvoľte aspoň jednu možnosť",
    requiredSingleSelect: (v) => v != null || "Zvoľte aspoň jednu možnosť",
    min10chars: (v) => (v && v.length >= 9) || "Pole musí mať aspoň 10 znakov",
    requiredFiles: (v) => v.length > 0 || "Nahrajte aspoň jeden súbor",
    email: (v) => {
        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return pattern.test(v) || "Invalid e-mail.";
    },
};