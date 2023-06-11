import { usePage, useForm } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton";
import GuestLayout from "@/Layouts/GuestLayout";
import dayjs from "dayjs";
import "dayjs/locale/ja";
import { Inertia } from "@inertiajs/inertia";

const Done = () => {
    const { date, time, permalink, auth } = usePage().props;
    dayjs.locale("ja");
    const appodate = dayjs(date).format("M月D日 (ddd)");

    const hundleGoback = () => {
        Inertia.visit(route("appoint.inertiaIndex", { permalink }), {
            preserveState: true,
        });
    };

    return (
        <>
            <GuestLayout>
                <div className="mt-5 flex flex-col items-center">
                    <h1 style={{ color: "green" }}>
                        以下の内容で予約を確定しました
                    </h1>
                    <h1 className="mt-2">日にち：{appodate}</h1>
                    <h1>時間：{time}</h1>
                    <div className="mt-2">
                        <PrimaryButton onClick={hundleGoback}>
                            カレンダーに戻る
                        </PrimaryButton>
                    </div>
                </div>
            </GuestLayout>
        </>
    );
};
export default Done;
