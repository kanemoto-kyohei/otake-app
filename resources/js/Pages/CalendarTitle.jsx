import PrimaryButton from "@/Components/PrimaryButton";
import React from "react";
import "./responsivestyle.css";

const CalendarTitle = (props) => {
    const { carender_elements } = props;

    const isTablet = window.matchMedia(
        "(min-width: 1024px) and (max-width: 2800px)"
    ).matches;
    const isMobile = window.matchMedia("(max-width: 768px)").matches;

    const HundlePrevWeek = () => {
        window.location.href = `?week=${carender_elements.previousWeek}&year=${carender_elements.previousYear}`;
    };

    const HundleNextWeek = () => {
        window.location.href = `?week=${carender_elements.nextWeek}&year=${carender_elements.nextYear}`;
    };

    return (
        <div>
            <div className="flex justify-center items-center py-4">
                <div
                    className={`${isTablet ? "tablet-right" : ""}${
                        isMobile ? "mobile-right" : ""
                    }`}
                >
                    <PrimaryButton onClick={HundlePrevWeek}>先週</PrimaryButton>
                </div>
                <div>
                    <h2>{carender_elements["currentYear"]}年</h2>
                </div>
                <div
                    className={`${isTablet ? "tablet-left" : ""}${
                        isMobile ? "mobile-left" : ""
                    }`}
                >
                    <PrimaryButton onClick={HundleNextWeek}>次週</PrimaryButton>
                </div>
            </div>
        </div>
    );
};
export default CalendarTitle;
