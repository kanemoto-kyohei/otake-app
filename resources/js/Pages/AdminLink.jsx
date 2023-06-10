import { usePage, Head, useForm } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import React from "react";

const AdminLink = () => {
    const { flash, auth } = usePage().props;
    const { data, setData, post, errors } = useForm({
        permalink: "",
    });

    function submit(e) {
        e.preventDefault();
        post(route("admin.inertiaLink"));
    }

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="MyCalendar" />
            <h1 className="text-center mt-3 mb-3">
                あなたのカレンダーのリンクを入力してください
            </h1>
            {flash.error && (
                <div className="text-center">
                    <div style={{ color: "red" }}>{flash.error}</div>
                </div>
            )}

            <form onSubmit={submit}>
                <div className="flex justify-center">
                    <InputLabel
                        className="mb-2"
                        htmlFor="permalink"
                        value="リンク"
                    />
                </div>
                <div className="flex justify-center">
                    <TextInput
                        id="permalink"
                        type="permalink"
                        name="permalink"
                        value={data.permalink}
                        className="mt-1 block"
                        autoComplete="username"
                        isFocused={true}
                        onChange={(e) => setData("permalink", e.target.value)}
                    />

                    {errors.permalink && <div>{errors.permalink}</div>}
                    <InputError message={errors.permalink} className="mt-2" />
                </div>
                <div className="flex justify-center mt-4">
                    <PrimaryButton>送信</PrimaryButton>
                </div>
            </form>
        </AuthenticatedLayout>
    );
};
export default AdminLink;
