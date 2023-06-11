import { usePage, Head, Link, useForm } from "@inertiajs/react";
import CancelButton from "@/Pages/CancelButton";
import GuestLayout from "@/Layouts/GuestLayout";
import dayjs from "dayjs";
import "dayjs/locale/ja";

const AppoDisplay = () => {
    const { flash, user_appointments, permalink } = usePage().props;

    console.log(permalink);
    dayjs.locale("ja");

    const list = () => {
        if (user_appointments && user_appointments.length > 0) {
            return user_appointments.map((appointment, index) => (
                <li key={index}>
                    {dayjs(appointment.date).format("M月D日 (ddd)")} :{" "}
                    {appointment.time}
                    <CancelButton
                        date={appointment.date}
                        time={appointment.time}
                        id={appointment.id}
                        permalink={permalink}
                    />
                </li>
            ));
        }
    };

    return (
        <GuestLayout>
            <h1 className="text-center">予約済み一覧</h1>
            {flash.message && (
                <div style={{ color: "green" }}>{flash.message}</div>
            )}
            {list()}
        </GuestLayout>
    );
};
export default AppoDisplay;
