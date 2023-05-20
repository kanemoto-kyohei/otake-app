import { usePage, Head, useForm } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import React from "react";

const UserLink = () => {
    const { flash, auth } = usePage().props;
    const { data, setData, post, errors } = useForm({
        user_permalink: "",
    });
    function submit(e) {
        e.preventDefault();
        post(route("appoint.inertiaLinkconfirm"));
    }

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="MyCalendar" />
            <h1 className="text-center mt-4 mb-3">
                管理者に教えられたリンクを入力してください
            </h1>
            {flash.message && (
                <div className="text-center mt-4 mb-3" style={{ color: "red" }}>
                    {flash.message}
                </div>
            )}

            <form onSubmit={submit}>
                <div className="flex justify-center">
                    <InputLabel
                        className="mb-2"
                        htmlFor="user_permalink"
                        value="リンク"
                    />
                </div>
                <div className="flex justify-center">
                    <TextInput
                        id="user_permalink"
                        type="user_permalink"
                        name="user_permalink"
                        value={data.user_permalink}
                        className="mt-1 block"
                        autoComplete="username"
                        isFocused={true}
                        onChange={(e) =>
                            setData("user_permalink", e.target.value)
                        }
                    />

                    {errors.user_permalink && (
                        <div>{errors.user_permalink}</div>
                    )}
                    <InputError
                        message={errors.user_permalink}
                        className="mt-2"
                    />
                </div>
                <div className="flex justify-center mt-4">
                    <PrimaryButton className="flex-center">送信</PrimaryButton>
                </div>
            </form>
        </AuthenticatedLayout>
    );
};
export default UserLink;
