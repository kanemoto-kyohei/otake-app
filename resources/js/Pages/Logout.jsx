import PrimaryButton from "@/Components/PrimaryButton";
import { usePage, Head, Link, useForm } from "@inertiajs/react";

const Logout = () => {
    return (
        <>
            <PrimaryButton href={route("logout")} method="post">
                ログアウトする
            </PrimaryButton>
        </>
    );
};

export default Logout;
