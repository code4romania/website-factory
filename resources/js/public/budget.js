import * as echarts from 'echarts/core';
import { TreemapChart } from 'echarts/charts';
import { CanvasRenderer } from 'echarts/renderers';

import { TitleComponent, TooltipComponent } from 'echarts/components';

echarts.use([TitleComponent, TooltipComponent, TreemapChart, CanvasRenderer]);

const valueFormatter = (value) => {
    return value.toLocaleString(document.documentElement.lang);
};

export default function (el, { expression }, { evaluate }) {
    const chart = echarts.init(el);

    const args = evaluate(expression);

    const rich = {
        name: {
            fontSize: 12,
            color: '#FFF',
        },
        value: {
            fontSize: 18,
            fontWeight: 'bold',
            color: '#FFF',
        },
        hr: {
            width: '100%',
            borderColor: '#FFF',
            borderWidth: 0.25,
            height: 0,
            lineHeight: 10,
        },
    };

    chart.setOption({
        tooltip: {
            valueFormatter,
        },
        textStyle: {
            fontFamily: `ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"`,
        },
        series: [
            {
                name: args.name || null,
                type: 'treemap',

                left: 0,
                top: 55,
                right: 0,
                bottom: 0,
                leafDepth: 2,

                animation: false,
                roam: false,

                upperLabel: {
                    show: true,
                    padding: [12, 6],
                    height: 70,
                    rich,
                },
                label: {
                    show: true,
                    padding: 10,
                    position: 'insideTopLeft',
                    formatter: (params) =>
                        [
                            `{name|${params.name}}`,
                            '{hr|}',
                            `{value|${valueFormatter(params.value)}}`,
                        ].join('\n'),
                    rich,
                },
                breadcrumb: {
                    show: true,
                    emptyItemWidth: 22,
                    top: 16,
                    left: 16,
                    bottom: 'auto',
                },
                colorSaturation: [0.25, 0.45],
                itemStyle: {
                    borderColorSaturation: 0.6,
                    borderWidth: 4,
                    padding: [6, 12],
                    gapWidth: 4,
                },
                levels: [
                    {
                        upperLabel: {
                            show: true,
                            rich: {
                                name: {
                                    color: '#000',
                                },
                                value: {
                                    color: '#000',
                                },
                                hr: {
                                    borderColor: '#000',
                                },
                            },
                        },
                        itemStyle: {
                            borderWidth: 16,
                            gapWidth: 16,
                        },
                    },
                ],
                data: args.data,
            },
        ],
    });

    window.addEventListener('resize', chart.resize);

    return chart;
}
